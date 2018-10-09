<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-15
 * Time: 오후 10:24
 */

namespace Mirage\MainBundle\Controller;
use Mirage\MainBundle\Document\Ark;
use Mirage\UserBundle\Entity\IArk;
use Mirage\UserBundle\Entity\IArkPhase;
use Mirage\UserBundle\Entity\Temporis;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Mirage\UserBundle\Controller\Controller;
use Mirage\MainBundle\Game\SystemMassage;
use Mirage\AdminBundle\Form\Type\UserType;
use Mirage\UserBundle\Entity\User;
use Mirage\UserBundle\Entity\Player;
use Mirage\UserBundle\Entity\UserDevice;
use Mirage\UserBundle\Entity\IDeck;


class RegisterController extends Controller
{

    /**
     * @Route("/list", name="admin_userlist")
     * @Template()
     */
    public function userAction()
    {
        $em = $this->getDoctrine();
        $user_list = $em->getRepository('MirageUserBundle:User')
            ->findByIsenabled(1);

        return array('users' => $user_list,);
    }
//    전 가입 절차
//    /**
//     * @Route("/create", name="user_create")
//     * @Template()
//     */
//    public function createAction(Request $request)
//    {
//        return $this->onEdit(null, $request);
////        return array();
//    }

    /**
     * @Route("/create", name="user_create")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager('user1_admin');
        if(isset($id)){
            $user = $em->getRepository('MirageUserBundle:User')->find($id);
        } else $user = new User();
        $email = self::checkStringParameter( $request->get('email'));
      //  $nickName = self::checkStringParameter( $request->get('user_name') );
        $this->createAccount($em, $user, $email);
        return $this->forward('MirageMainBundle:Register:endRegister', array("request"=> $request));
    }


    /**
     * @Route("/edit/{id}", name="user_edit")
     * @Template()
     */
    public function editAction($id)
    {
        if(empty($id)){
            $id = null;
        }

        return $this->onEdit($id);
    }

    public function onEdit($id = null, $request){
        $em = $this->getDoctrine()->getManager('user1_admin');
        if(isset($id)){
            $user = $em->getRepository('MirageUserBundle:User')->find($id);
        } else $user = new User();
//            $user->setId(0);

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isValid() ){
            $data = $form->getData();
            $duflicate = $em->getRepository('MirageUserBundle:User')->findOneByUsername($data->getUsername());
            if(isset($duflicate)){
                $form->addError(new FormError("ID가 이미 존재합니다."));
            }else if(strlen($data->getPassword()) < 8){
                $form->addError(new FormError("패스워드는 8자 이상입니다."));
            }else{
                $deviceData = array(
                    'idDevice' =>$form->get('id_device')->getData(),
                    'deviceName' =>$form->get('device_name')->getData(),
                    'osType' =>$form->get('os_type')->getData(),
                );
                $this->createAccount($em, $user, $data);
                return $this->redirect($this->generateUrl("end_register"));
            }

        }

        return array('user' => $user, 'form' => $form->createView());
    }

    /**
     * @Route("/success", name="end_register")
     * @Template()
     */
    public function endRegisterAction(Request $request){

        return $this->forward('MirageUserBundle:Top:login', array("request"=> $request));
    }

    public function createAccount($em, $user, $email){

        //Player테이블
        $player = new Player($this->nowTime());
        $player->setName(null); //임시로 메일넣음
        $em->persist($player);
        $em->flush();
        //User테이블
        $user->setUsername(null);
        $user->setEmail($email);
        $salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $pw_raw = $email;
        $user->setSalt($salt);
        $user->setIsActive(true);
        $password = $this->get('security.encoder_factory')->getEncoder($user)->encodePassword($pw_raw, $salt);
        $user->setPassword($password);
        $user->setIdPlayer($player->getId());
        $user->setCreated($this->nowTime());
        $user->setUpdated($this->nowTime());
        $user->setRole("ROLE_USER");
        $em->persist($user);
        $em->flush();

        //초기지급IArk
        $iArk = new IArk($player, 1103, $this->nowTime());
        $em->persist($iArk);
        $em->flush();
        //초기지급IArkPhase (이사야 초기 아크와 아크페이즈)
        $iArkPhase = new IArkPhase($this->get('doctrine_mongodb')->getRepository("MirageMainBundle:Ark")->searchOnePhaseByIdPhase(1108), $this->nowTime());
        $iArkPhase->setIdIArk($iArk);
        $em->persist($iArkPhase);
        $em->flush();
        $iArk->setIdCurrentPhase($iArkPhase);

        //초기지급IDeck
        $iDeck = new IDeck();
        $iDeck->setCreated($this->nowTime());
        $iDeck->setUpdated($this->nowTime());
        $iDeck->setIsEnabled(true);
        $iDeck->setIdPlayer($player);
        $em->persist($iDeck);
        $em->flush();


        //초기지급IItem
        //Temporis테이블
        $teporis = new Temporis();
        $teporis->setIdPlayer($player->getId());
        $em->persist($teporis);
        $em->flush();
        //그외 이벤트지급
        //플레이어 내부정보 업데이트
        $player->setIdMainDeck($iDeck);

        $em->flush();

        return $player;
    }

}