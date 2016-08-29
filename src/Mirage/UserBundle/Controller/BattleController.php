<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-16
 * Time: 오후 2:19
 */

namespace Mirage\UserBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Util\Debug;
use Mirage\MainBundle\Game\ArkInfo;
use Mirage\UserBundle\Controller\Controller;
use Mirage\UserBundle\Services\GMemcached;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Mirage\MainBundle\Document\Notification;
use Mirage\UserBundle\Entity\IDeckRepository;
use Mirage\UserBundle\Entity\IArkRepository;

class BattleController extends Controller
{
//    /**
//     * @Route("/enc", name="battle_encounter")
//     */
//    public function encounterAction(Request $request){
//        $idEnc = $request->get('id_battle');
//        $idPlayer = $request->get('id_player');
//        $idPlayerDeck = $request->get('id_player_deck');
//        $em = $this->getDoctrine()->getManager('user1_readonly');
//
//        if(!empty($idEnc)){
//            $encounter = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Encounter')->findOneByEncId((int)$idEnc);
//            $playerDeck = $em->getRepository('MirageUserBundle:IDeck')->findOneById($idPlayerDeck)->getArkPos();
//            $encounter->getTilePos();
//
//           // var_dump($encounter->getEnemyPos());
//            foreach($playerDeck as $key => $value){
//                if(!empty($value)){
//                    $playerArks[$key] = $value;
//                    var_dump($key, $value->getIdArk());
//                }
//            }
//        }
//        return new Response(json_encode($playerArks));
//    }

    /**
     * @Route("/enc", name="battle_encounter")
     */
    public function startBattleAction(Request $request){
//        유저가 누군지는 멤캐쉬 참조. 덱ID와 다를경우 이놈은 어뷰징임
//        GMemcached::get('Id')

        $idEnc = $request->get('id_battle');
        $idPlayer = $request->get('id_player');
        $idPlayerDeck = $request->get('id_player_deck');
        $em = $this->getDoctrine()->getManager('user1_readonly');
        $mongoDtr = $this->get('doctrine_mongodb');
        $info = null;
        $now = $this->nowTime();

        $mPlayer = $this->getDoctrine()->getRepository('MirageUserBundle:Player')->findBy(1);

        if(!empty($idEnc)) {
            $encounter = $mongoDtr->getRepository('MirageMainBundle:Encounter')->findOneByEncId((int)$idEnc);
            if($encounter->getStartDay() < $now && $encounter->getEndDay() > $now){
                $playerDeck = $em->getRepository('MirageUserBundle:IDeck')->loadArkByIdIDeck($idPlayerDeck, $mPlayer);
//                var_dump($playerDeck->getArkPos());

//                foreach($playerDeck->getArkPos() as $pos => $ark){
//                    if(isset($ark)){
//                        var_dump($this->ObjectToJson(
//                            $em->getRepository('MirageUserBundle:IArk')->loadIArkByIdArk($ark->getId())
//                        ));
//                    }
//                   // $playerArks[] = array("ark"=>$mongoDtr->getRepository('MirageMainBundle:Ark')->findOneByArkId($ark->getIdArk()));
//                }
//                var_dump($this->ObjectToJson($playerArks));

        //        $mapInfo = array("backgroudPicture"=>$encounter->getBgType(),"id_bgm"=>$encounter->getBgmId(),"yLength"=>$encounter->getYLength(),"defaultTile"=>$encounter->getDefaultTile(),"tilePos"=>$encounter->getTilePos(),"eventTrigger"=>$encounter->getEventTrigger());

                $info =  array();


            }
            else{
                $info = "현재 운영되지 않는 던전입니다.";
            }
        }
        $ark = $mongoDtr->getRepository('MirageMainBundle:Ark')->findOneByArkId(50);
        return new Response($this->ObjectToJson($playerDeck));
    }


}