<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-06-20
 * Time: 오후 9:43
 */

namespace Mirage\UserBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Mirage\MainBundle\Document\SummonTable;
use Mirage\UserBundle\Services\GMemcached;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class Controller extends BaseController
{

//    public function getPlayerWithCache($idPlayer){
//        $player = GMemcached::get(GMemcached::PREFIX_USER.strval($idPlayer));
//
//        if(empty($player)){
//            $player = $this->getPlayer($token);
//            GMemcached::set(GMemcached::PREFIX_USER.strval($player->getId()), $player, 30000);
//        }
//        return $player;
//    }

    public function getPlayer($token){
        $em = $this->getDoctrine()->getManager('user1_admin');
        $token = $this->checkStringParameter($token);
        $user = $em->getRepository('MirageUserBundle:User')->findOneBySalt($token);
        if(empty( $user))
        {
            return 9000003;
        }
        $idPlayer = $user->getIdPlayer();
        if(empty( $idPlayer))
        {
            //idPlayer가 없다면 뭔가 문제가 생겨 플레이어ID가 생성되지 않았다는 의미
            return 9000004;
        }
        $player = $em->getRepository('MirageUserBundle:Player')->find($idPlayer);
        if(empty( $player))
        {
            //idPlayer는 있는데, player가 없다면 삭제됬다는 의미.
            return 9000005;
        }
        //템포리스 저축. 마지막 lastLogin으로부터 10분 이후면 로그아웃으로 침
        $temporis = $em->getRepository('MirageUserBundle:Temporis')->findOneByIdPlayer($idPlayer);
        $temporis->addTime($player->getLastLogin(), $this->nowTime());

        $player->setLastLogin($this->nowTime());
        $em->flush();
        $em->clear();
        $player->unsetForRequest();
        return $player;
    }

    public function getEditNickNamePlayer($token, $name){
        $em = $this->getDoctrine()->getManager('user1_admin');
        $token = $this->checkStringParameter($token);
        $user = $em->getRepository('MirageUserBundle:User')->findOneBySalt($token);
        if(empty( $user))
        {
            return  9000001;
        }
        $idPlayer = $user->getIdPlayer();
        if(empty( $idPlayer))
        {
            //idPlayer가 없다면 뭔가 문제가 생겨 플레이어ID가 생성되지 않았다는 의미
            return 9000004;
        }
        $player = $em->getRepository('MirageUserBundle:Player')->find($idPlayer);
        if(empty( $player))
        {
            //idPlayer는 있는데, player가 없다면 삭제됬다는 의미.
            return 9000005;
        }
        if(empty($name))
        {
            return 9000006;
        }
        $player->setName($name);
        //템포리스 저축. 마지막 lastLogin으로부터 10분 이후면 로그아웃으로 침
        $temporis = $em->getRepository('MirageUserBundle:Temporis')->findOneByIdPlayer($idPlayer);
        $temporis->addTime($player->getLastLogin(), $this->nowTime());

        $player->setLastLogin($this->nowTime());
        $em->flush();
        $em->clear();
        return $player;
    }

    public function checkStringParameter($token)
    {
        if(strstr($token,'\"')!=false)
        {
            $token = substr($token,2,-2);
        }elseif(strstr($token,'"')!=false)
        {
            $token = substr($token,1,-1);
        }
        return $token;
    }


    public function getTotalInfo($token){
        $em = $this->getDoctrine()->getManager('user1_admin');
        $player = $this->getPlayer($token);
        if(is_numeric($player))
        {
            return $player;
        }
        $arks = $em->getRepository('MirageUserBundle:IArk')->findByIdPlayer($player->getId());
        $deck = $em->getRepository('MirageUserBundle:IDeck')->findByIdPlayer($player->getId());
       // $temporis = $em->getRepository('MirageUserBundle:Temporis')->findOneByIdPlayer($player->getId());

        return array("player" => $player, "arks"=> $arks, "deck"=> $deck/*, "temporis"=>$temporis*/);
    }

    public function getOnlyPlayerInfo($token){
        $player = $this->getPlayer($token);

        return $player;
    }

    //디버그시엔 디버그용 시간대를 뱉음. 그외엔 현재시각을 뱉음
    public function nowTime(){
        $time = time();
        return $time;
    }

    public function createUserCodeAction(){

    }

    public function ObjectToJson($object){
//        $encoders = array(new XmlEncoder(), new JsonEncoder());
//        $normalizers = array(new GetSetMethodNormalizer());
//        $serializer = new Serializer($normalizers, $encoders);
        $serializer = $this->container->get('jms_serializer');
        return $serializer->serialize($object, 'json');
    }

    public function JsonToClass($object, $classItem){
        $serializer = $this->container->get('jms_serializer');
      //  return $serializer->deserialize($object,'Doctrine\Common\Collections\ArrayCollection' , 'json');
        return $serializer->deserialize($object, get_class($classItem), 'json');
    }

    public function giveArks()
    {
        //TODO:여기에 UserBundle의 SummonCotroller의 registerArk()를 구현해놓을것.
    }

    public function summon($summon, $mode, $repeat){
        $results = array();
        $randMax = $summon->getTableRandMax($mode->getMinGrade());

        for($i=0; $i < $repeat; $i++){
            //TODO :: 랜덤픽 방식이 너무 단순함. 나중에 커스터마이징RAND할 것
            $rand = rand(1, $randMax);
            $randEndStr = $rand."/".$randMax;
            $base = 0;
            $grade = 0;
            foreach($summon->getSummonTables() as $table){
                if($mode->getMinGrade() > $table->getGrade()) continue;
                $base += $table->getGravity();
                if($rand < $base){
                    $grade = $table->getGrade();
                    break;
                }
            }
            $itemId = $table->getItems()[rand(1, count($table->getItems()))-1];

            $results[] = array("rendEndStr" => $randEndStr, "itemId"=> $itemId);

        }

        //아이템 찾아서 등록
        foreach($results as &$result) {
            switch ($summon->getTargetType()) {
                case GameConfig::SUMMON_TARGET_ARKPHASE:
                    $ark = $this->get('doctrine_mongodb')->getRepository(GameConfig::$SUMMON_TARGET_REPOSITORY_STR[GameConfig::SUMMON_TARGET_ARKPHASE])
                        ->findOneByIdPhase($result['itemId']);
                    if(empty($ark)) var_dump($result['itemId']);
                    foreach ($ark->getPhases() as $phase) {
                        if ($phase->getIdPhase() == $result['itemId']) {
                            $result['item'] = $phase;
                            break;
                        }
                    }
                    break;
                case GameConfig::SUMMON_TARGET_EQUIPMENT:
                    break;
                case GameConfig::SUMMON_TARGET_ITEM:
                    break;
            }
        }
        return $results;
    }

    public function getSummonRate($summon){
        $rates = [];
        $totalGravity = $summon->getTotalGravity();


        foreach($summon->getSummonTables() as &$table){

            $itemGravity = floor($table->getGravity() / count($table->getItems()));
            $list = [];
            foreach($table->getItems() as &$item){
                $list['id'] = $item;
                $list['rate'] = (string)(round($itemGravity/$totalGravity  * 100, 4))."%";
                $list['grade'] = $table->getGrade();
//                var_dump($list);
                array_push($rates, $list);
            }
        }
        return $rates;
    }

}