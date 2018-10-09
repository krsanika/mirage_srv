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
use Mirage\MainBundle\Game\SystemMassage;

class TopController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request){
        $em = $this->getDoctrine()->getManager('user1_readonly');

        //개발자로그인일 시
        // http://1.229.95.13:9000/app_krsanika.php/user/login/developer?created=470334308
//        $created = (int)$request->get('created');
//        if($created < 1000000000){
//            $user = $em->getRepository('MirageUserBundle:User')->findOneByCreated($created);
//            return new Response($this->ObjectToJson($user->getSalt()));
//        }


        $email = $request->get('email');
        $email = self::checkStringParameter($email);
        $user = $em->getRepository('MirageUserBundle:User')->findOneByEmail($email);

        if(empty($user) || empty($email)){
            return $this->forward('MirageMainBundle:Register:create', array("request"=> $request));
           // return new Response($this->ObjectToJson(SystemMassage::ERROR_USER_NOT_EXIST));
        }

        //개발자로그인일 시
        if(!empty($user) && $user->getRole() == "ROLE_ADMIN")
        {
            return new Response($this->ObjectToJson($user->getSalt()));
        }

        return new Response($this->ObjectToJson($user->getSalt()));
    }

    /**
     * @Route("/login/created", name="login_develop")
     */
    public function loginDeveloperAction(Request $request){


        $em = $this->getDoctrine()->getManager('user1_readonly');
        $created = (int)$request->get('created');
        $user = $em->getRepository('MirageUserBundle:User')->findOneByCreated($created);

        if(empty($user) || empty($created)){
            return new Response($this->ObjectToJson(SystemMassage::ERROR_USER_NOT_EXIST));
        }
        return new Response($this->ObjectToJson($user->getIdUser()->getSalt()));
    }

    /**
     * @Route("/top", name="top")
     */
    public function topAction(Request $request){
        $token = $request->get('token');
        if(empty($token)) return new Response(null);
        $player = $this->getPlayer($token);

        if(is_int($player)){ return new Response($player);}
//      이미 전투가 있는 사람일수도 있어욧
        $existEncounter = $this->getDoctrine()->getRepository('MirageUserBundle:IEncounter')->findBy(array('idPlayer'=>$player->getId(), 'isEnabled'=>true));
        if(!isset($existEncounter))
            //에러코드 추가해야함
            return new Response(SystemMassage::ERROR_ENCOUNTER_EXIST);

        //유저 정보 확인
//        $player = $this->getPlayer($idPlayer);
        $playerInfo = $this->getOnlyPlayerInfo($token);
        $favoredChara =  $this->getDoctrine()->getRepository('MirageUserBundle:IArkPhase')->findBy(array('id'=>$playerInfo->getIdFavoredChara(),'idPlayer'=>$player->getId(), 'isEnabled'=>true));
        $fcInfo =  $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Ark')->findArkTopInfoByIPhase($favoredChara[0]);

        $infos = array('player'=>$playerInfo, 'favored_chara'=>$fcInfo);
        return new Response($this->ObjectToJson($infos));
    }

    /**
     * @Route("/nickChange", name="nick_change")
     */
    public function nickChangeAction(Request $request)
    {
        $token = self::checkStringParameter( $request->get('token'));
        $name = self::checkStringParameter(  $request->get('name'));
        $player = self::getEditNickNamePlayer($token, $name);

        return $this->forward('MirageUserBundle:Top:top', array("request"=> $request));

    }

    /**
     * @Route("/gatcha", name="getGatchaCard")
     */
    public function getGatchaCardAction(Request $request){
        $idPlayer = $request->get('token');
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