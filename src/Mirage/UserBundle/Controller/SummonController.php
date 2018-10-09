<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-09-08
 * Time: 오후 8:56
 */

namespace Mirage\UserBundle\Controller;

use Mirage\UserBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Util\Debug;
use Mirage\UserBundle\Entity\IArk;
use Mirage\UserBundle\Entity\IArkPhase;
use Mirage\UserBundle\Services\GMemcached;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Mirage\AdminBundle\Controller\SummonController as AdminSummon;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class SummonController extends Controller
{
    /**
     * @Route("/", name="summon_get")
     */
    public function getSummonAction(){
        $allSummons = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Summon')->findAll();
        foreach($allSummons as &$summon){
            $summon->unsetId();
            $summon->unsetTables();
            $summon->modesAtPossible($this->nowTime());
        }
        return new Response($this->ObjectToJson(array("summons"=>$allSummons)));
    }

    /**
     * @Route("/observe", name="summon_observe")
     */
    public function observeAction(Request $request){
        $token = (int)$request->get('token');
        $modeId = (int)$request->get('id_mode');
        $count = (int)$request->get('count');
        $em = $this->getDoctrine()->getManager('user1_admin');
        $summon = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Summon')->findOneByModeId($modeId);
        //해당가챠를 수행할수있는지 확인하는 부분 지금은 스킵

        $user = $em->getRepository('MirageUserBundle:User')->findOneBySalt($token);
        $idPlayer = $user->getIdPlayer();
        $player = $em->getRepository('MirageUserBundle:Player')->find($idPlayer);

        $mode = $summon->getCurrentMode($modeId);

        //TODO: 만약 $mode->getIsRepeat()가 true인 경우엔 $count 만큼 반복이나 곱하여 처리해줘야함.
        //미래의 누군가 화이팅.
        //플레이어의 재화를 소모하며, 재화가 모자른 경우엔 에러 메세지를 뱉어준다.
        $resultPlayer = $player->addMoney($mode->getBillingType(),-($mode->getPrice()));

        if(is_bool($resultPlayer))
        {
            //TODO:에러 메세지 넣어줄것
            $results = "재화가 모자릅니다.";
        }else
        {
            $mainDeck = $em->getRepository('MirageUserBundle:IDeck')->findOneById($player->getIdMainDeck()->getId());
            $player->setIdMainDeck($mainDeck);
            $em->flush();


        //가챠산출
        $results = AdminSummon::summon($summon, $summon->getCurrentMode($modeId), $count);

        //사용자DB에 등록
        foreach($results as &$result){
            switch(get_class($result['item'])){
                case 'Mirage\MainBundle\Document\Phase':
                    $result += $this->registerArk($result['item'], $player, $em);
                    break;
            }
        }

        //이번 가챠에서 겹치는 카드는 삭제하고 하나로 합쳐줌
/*
        foreach($results as &$result){
        }
*/
        }
        return new Response($this->ObjectToJson(array("results"=> $results)));
    }

    public function registerArk($phase, $player, $em){
//        var_dump('phaseID:'.$phase->getPhaseId());
        //중복페이즈가 있는지 확인
        $isSame = false;
        $iPhase = null;
        $ark = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Ark')->findOneByPhaseId($phase->getPhaseId());
        $iArk = $em->getRepository('MirageUserBundle:IArk')->findOneBy(array('idArk'=>$ark->getArkId(), 'idPlayer'=>$player->getId()));
//        var_dump('haveArk', !empty($iArk));
        if(empty($iArk)){
            //아크가 없으면 걍 드림
            $iArk = new IArk($player, $ark->getArkId(), $this->nowTime());
            $em->persist($iArk);
        }else{
/*            foreach($iArk->getIPhases() as $haveIPhase){
                if($haveIPhase->getIdArkPhase() == $phase->getPhaseId()){
                    $iPhase = $haveIPhase;
                    $isSame = true;
                    break;
                }
            }*/
        }

//        var_dump('isNew', !$isSame);
        //중복이 없으면 새로 만들어서 기입. 있으면 겹침
//        if(!$isSame){
            $iPhase = new IArkPhase($phase, $this->nowTime());
            $iArk->addIPhase($iPhase);
            $iArk->setCurrentHp($iPhase->getHp());
            $iPhase->setIdIArk($iArk);
            $em->persist($iPhase);
//        }else{
//            //전능력치+1
//            $iPhase->addStackCount();
//            $iPhase->setIdIArk($iArk);
//        }

        $em->flush();

        //해당 아크로 생긴 첫 페이즈면 현재 페이즈로 등록
//        var_dump($iArk->getIPhases()->count());
        $iArk = $em->getRepository('MirageUserBundle:IArk')->findOneBy(array('idArk'=>$ark->getArkId(), 'idPlayer'=>$player->getId()));
        if($iArk->getIPhases()->count() == 1){
            $iPhase = $em->getRepository('MirageUserBundle:IArkPhase')->findOneBy(array('idIArk'=>$iArk->getId()));
            $iArk->setIdCurrentPhase($iPhase);
//            $em->persist($iArk);
            $em->flush();
        }




        $result = array(
            'isNew' => !$isSame,
            'stackCount' => $iPhase->getStackCount(),
        );

        return $result;
    }




}