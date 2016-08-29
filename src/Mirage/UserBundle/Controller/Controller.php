<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-06-20
 * Time: 오후 9:43
 */

namespace Mirage\UserBundle\Controller;

use Mirage\UserBundle\Services\GMemcached;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class Controller extends BaseController
{
    public function getPlayer($idPlayer){

        $player = GMemcached::get(strval($idPlayer));

        if(empty($player)){
            $em = $this->getDoctrine()->getManager('user1_admin');
            $player = $em->getRepository('MirageUserBundle:Player')->findOneById($idPlayer);
            $player->setLastLogin($this->nowTime());
            $em->persist($player);
            $em->flush();
            GMemcached::set(strval($player->getId()), $player, 30000);
        }
        return $player;
    }

    /*Device를 얻어오면서, 로그인을 시켜놓는다.*/
//    public function getDevice($idDevice){
//        $device = GMemcached::get($idDevice);
//        $playerInfo = null;
//
//        if(empty($device)) {
//            $em = $this->getDoctrine()->getManager('user1_admin');
//            $device = $em->getRepository('MirageUserBundle:UserDevice')->findOneByIdDevice($idDevice);
//            $playerInfo = $em->getRepository('MirageUserBundle:UserDevice')->findOneByIdDevice($idDevice)->getIdPlayer()->getId();
//            if(empty(GMemcached::get($playerInfo))){
//                $this->getPlayer($playerInfo);
//            }
//            GMemcached::set($device->getIdDevice(), $device, 30000);
//        }
//        return $device;
//    }

    public function getIdPlayerOfDevice($idDevice){
        $em = $this->getDoctrine()->getManager('user1_admin');
        $idPlayer = $em->getRepository('MirageUserBundle:UserDevice')->findOneByIdDevice($idDevice)->getIdPlayer()->getId();
        return $idPlayer;
    }

    public function getTotalInfo($idPlayer){
        $em = $this->getDoctrine()->getManager('user1_admin');
        $player = $this->getPlayer($idPlayer);
        $arks = $em->getRepository('MirageUserBundle:IArk')->findByIdPlayer($idPlayer);
        $deck = $em->getRepository('MirageUserBundle:IDeck')->findByIdPlayer($idPlayer);
        return array($player,$arks,$deck);
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

}