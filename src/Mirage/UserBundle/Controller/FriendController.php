<?php
/**
 * Created by PhpStorm.
 * User: Krsanika
 * Date: 2017-04-05
 * Time: 오후 2:55
 */


namespace Mirage\UserBundle\Controller;

use Mirage\UserBundle\Controller\Controller;
use Mirage\UserBundle\Entity\IFriend;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Mirage\MainBundle\Game\SystemMassage;
use Mirage\MainBundle\Game\GameConfig;

class FriendController extends Controller
{



    /**
     * @Route("/", name="friend_index")
     * @Template()
     */
    public function indexAction(Request $request){
        $token = $request->get('token');
        $player = $this->getPlayer($token);
        if(empty($player) || is_int($player))
            return new Response(SystemMassage::ERROR_PLAYER_NOT_EXIST);


        $iFriends = $this->getDoctrine()->getRepository('MirageUserBundle:IFriend')->findByIdPlayerWithSupportPhases($player->getId());
        $applies = $this->getDoctrine()->getRepository('MirageUserBundle:IFriend')->findByIdFriendWithSupportPhases($player->getId());
        $waits = array();
        $friends = array();
        //가공
        foreach($iFriends as $iFriend){
            if($iFriend['isAccepted']){
                unset($iFriend['isAccepted']);
                $friends[] = $iFriend;
            }
            else{
                unset($iFriend['isAccepted']);
                $waits[] = $iFriend;
            }
        }


        return new Response($this->ObjectToJson(array('waits' => $waits, 'applies'=>$applies, 'friends'=>$friends)));
    }

    /**
     * @Route("/apply", name="friend_apply")
     * @Template()
     */
    public function applyAction(Request $request){
        $token = $request->get('token');
        $player = $this->getPlayer($token);
        if(empty($player) || is_int($player))
            return new Response(SystemMassage::ERROR_PLAYER_NOT_EXIST);

        $idApply = $request->get('apply');
        if(empty($idApply))
            //친구ID입력이 잘못됨
            return new Response(SystemMassage::ERROR_THAT_NOT_FRIEND);

        $em = $this->getDoctrine()->getManager('user1_admin');

        //친구ID가 가짜이거나 그런 사람이 있는지 없는지 확인
        $friend = $em->getRepository('MirageUserBundle:Player')->find($idApply);
        if(empty($friend))
            //그런 사람 없음
            return new Response(SystemMassage::ERROR_PLAYER_NOT_EXIST);

        //IFriend에 새 항목 개설
        $friend = new IFriend($player->getId(), $idApply, $this->nowTime());
        $em->persist($friend);
        $em->flush();


        return $this->redirectToRoute('friend_index', ['token'=>$token], 307);
    }

    /**
     * @Route("/accept", name="friend_accept")
     * @Template()
     */
    public function acceptAction(Request $request){
        $token = $request->get('token');
        $player = $this->getPlayer($token);

        $em = $this->getDoctrine()->getManager('user1_admin');

        //신청자가 있는지 검색
        $idApplier = $request->get('id_apply');
        $applier = $em->getRepository('MirageUserBundle:Player')->find($idApplier);
        //없다면 이상함
        if(empty($player) || is_int($player) || empty($applier))
            return new Response(SystemMassage::ERROR_PLAYER_NOT_EXIST);

        //항목이 있는지 검색
        $accept = $em->getRepository('MirageUserBundle:IFriend')->findOneBy(['idPlayer'=>$applier->getId(), 'idFriend'=>$player->getId()]);
        //없다면 취하한 것
        if(empty($accept))
            return new Response(SystemMassage::ERROR_APPLY_REJECTED);

        //있으면 상대걸 승인하고 나에게 새 친구항목 만듬
        $accept->setIsAccepted(true);

        $myList = new IFriend($player->getId(), $idApplier, $this->nowTime());
        $myList->setIsAccepted(true);
        $em->persist($myList);
        $em->flush();


        return $this->redirectToRoute('friend_index', ['token'=>$token], 307);
    }


    /**
     * @Route("/delete", name="friend_delete")
     * @Template()
     */
    public function deleteAction(Request $request){
        $token = $request->get('token');
        $player = $this->getPlayer($token);

        $em = $this->getDoctrine()->getManager('user1_admin');

        //삭제할 놈이 있는지 검색
        $idDelete = $request->get('id_delete');
        $delete = $em->getRepository('MirageUserBundle:Player')->find($idDelete);
        //삭제할 놈이 내 친구리스트에 있는지 검색(등록신청취하와 친구끊기는 동일한 알고리즘임)
        $deleteFriend = $em->getRepository('MirageUserBundle:IFriend')->findOneBy(['idPlayer'=>$player->getId(), 'idFriend'=>$delete->getId()]);

        //없다면 이상함
        if(empty($player) || is_int($player) || empty($deleteFriend))
            return new Response(SystemMassage::ERROR_PLAYER_NOT_EXIST);

        //있으면 삭제함
        $deleteFriend->setUpdated($this->nowTime());
        $deleteFriend->setIsEnabled(false);
        $em->flush();

        return $this->redirectToRoute('friend_index', ['token'=>$token], 307);
    }

    /**
     * @Route("/thumbup", name="friend_thumbup")
     * @Template()
     */
    public function thumbUpAction(Request $request){
        $token = $request->get('token');
        $player = $this->getPlayer($token);
        $idFriend = $request->get('id_friend');

        //플레이어가 잘못되었을 경우 튕기기
        if(empty($player) || is_int($player) || empty($idFriend))
            return new Response(SystemMassage::ERROR_PLAYER_NOT_EXIST);



        $em = $this->getDoctrine()->getManager('user1_admin');
        $iFriend = $em->getRepository('MirageUserBundle:IFriend')->findOneBy(['idPlayer'=>$player->getId(), 'idFriend'=>$idFriend]);

        //하루 지났는지 체크
        if($iFriend->getUpdated()+86400 < $this->nowTime()){
            $iFriend->setUpdated($this->nowTime());
            //하루가 안지났으면 불가능하다
        }else return new Response(SystemMassage::ERROR_UNABLE_THUMBUP);



        //항목이 없으면 친구가 아닌겨
        if($iFriend->isEnabled() && $iFriend->IsAccepted()){
            $friend = $em->getRepository('MirageUserBundle:Player')->find($idFriend);
            $friend->setFpGive($friend->getFpGive()+75);
            $em->flush();
        }else return new Response(SystemMassage::ERROR_THAT_NOT_FRIEND);  


        return $this->redirectToRoute('friend_index', ['token'=>$token], 307);
    }





    /**
     * @Route("/support", name="friend_support")
     * @Template()
     */
    public function supportAction(Request $request){
        $token = $request->get('token');
        $player = $this->getPlayer($token);

        //플레이어가 잘못되었을 경우 튕기기
        if(empty($player) || is_int($player))
            return new Response(SystemMassage::ERROR_PLAYER_NOT_EXIST);

        //괜찮으면 친구부터 소환
        $em = $this->getDoctrine()->getManager('user1_admin');

        $friends = $em->getRepository('MirageUserBundle:IFriend')->findForSupportWithFriend($player->getId());



        //친구 이외를 확인해서 검색
        $withoutFriends = $em->getRepository('MirageUserBundle:IFriend')->findForSupportWithoutFriend($player->getId(), GameConfig::BATTLE_SURPPORT-count($friends));

        $result = array_merge($friends, $withoutFriends);




        return new Response($this->ObjectToJson($result));
    }



}