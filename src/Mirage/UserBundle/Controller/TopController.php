<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-06-26
 * Time: 오후 7:56
 */

namespace Mirage\UserBundle\Controller;

use Mirage\UserBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Mirage\UserBundle\Services\GMemcached;

class TopController extends Controller
{

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request){
        $idDevice = $request->get('id_device');
        $idPlayer = $this->getIdPlayerOfDevice($idDevice);
        $infos = $this->getTotalInfo($idPlayer);
        //$player = $this->getPlayer($idPlayer);
       // $this->get('doctrine_mongodb')->getRepository('');
        return new Response($this->ObjectToJson(/*$player*/$infos));
    }

    /**
     * @Route("/top", name="top")
     */
    public function topAction(Request $request){
        $idPlayer = $request->get('id_player');
        //유저 정보 확인
        $player = $this->getPlayer($idPlayer);
        return new Response($this->ObjectToJson($player));
    }

    /**
     * @Route("/gatcha", name="getGatchaCard")
     */
    public function getGatchaCardAction(Request $request){
        $idPlayer = $request->get('id_player');
        $idArk = $request->get('id_ark');
        $idArkPhase = $request->get('id_ark_phase');
        //유저 정보 확인
        $player = $this->getPlayer($idPlayer);
        $ark = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Ark')->findOneByArkId((int)$idArk);
        $arkPhase = $ark->getPhase($idArkPhase);
        $em = $this->getDoctrine()->getManager('user1_admin');
        if(!($this->checkHaveArk($idPlayer,$idArk))) {
            $this->giveArk($idPlayer,$ark);
        }
        if($this->checkHaveArkPhase($idPlayer,$idArkPhase)){

        }

        return new Response($this->ObjectToJson($player));
    }

    public function checkHaveArk($idPlayer,$idArk){
        $em = $this->getDoctrine()->getManager('user1_readonly');
        $arks = $em->getRepository('MirageUserBundle:IArk')->findByIdPlayer($idPlayer);
        foreach($arks as $ark){
            if($ark->getIdArk() == $idArk){
                return true;
            }
        }
            return false;
    }
    public function checkHaveArkPhase($idPlayer,$idArkPhase){
        $em = $this->getDoctrine()->getManager('user1_readonly');
        $arkPhases = $em->getRepository('MirageUserBundle:IArkPhase')->findByIdPlayer($idPlayer);
        foreach($arkPhases as $arkPhase){
            if($arkPhase->getIdArkPhase() == $idArkPhase){
                return true;
            }
        }
        return false;
    }

    public function giveArkPhase($idPlayer,$arkPhase){
        $newArkPhase = new IArkPhase();
        $newArkPhase->setIdPlayer($idPlayer);
        $newArkPhase->setIdArkPhase($arkPhase->getPhaseId());
        $newArkPhase->setAtk($arkPhase->getAtk());
        $newArkPhase->setDef($arkPhase->getDef());
        $newArkPhase->setSpd($arkPhase->getSpd());
        $newArkPhase->setLuk($arkPhase->getLuk());
        $newArkPhase->setIsEnable(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($newArkPhase);
        $em->flush();
    }
    public function giveArk($idPlayer,$ark){
        $newArk = new IArk();
        $newArk->setIdPlayer($idPlayer);
        $newArk->setIdArk($ark->getArkId());
        $this->giveArkPhase($idPlayer,$ark->getPhase());
        $edm = $this->getDoctrine()->getManager('user1_readonly');
        $newArk->setIdCurrentPhase($edm->getRepository('MirageUserBundle:IArkPhase'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($newArk);
        $em->flush();
        return $this->redirectToRoute('ark_index');
    }
}