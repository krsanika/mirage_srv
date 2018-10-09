<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-08-28
 * Time: 오후 11:30
 */

namespace Mirage\UserBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Util\Debug;
use Mirage\MainBundle\Game\ArkInfo;
use Mirage\UserBundle\Controller\Controller;
use Mirage\UserBundle\Entity\IDeck;
use Mirage\MainBundle\Game\ListIdPhases;
use Mirage\UserBundle\Services\GMemcached;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Mirage\MainBundle\Document\Notification;

class DeckController extends Controller
{
    /**
     * @Route("/", name="get_deck")
     */
    public function getDeckAction(Request $request){
        $token = $request->get('token');
        $player = $this->getPlayer($token);
        $iDecks = $this->getDoctrine()->getRepository('MirageUserBundle:IDeck')->findByIdPlayer($player->getId());
        $newDecks = null;
        foreach($iDecks as $iDeck){
            $newDeck = new IDeck();
//            $iDeck->unsetPlayer();
            $newDeck->unsetDBInfo();
            $newDeck->setDeckNumber($iDeck->getDeckNumber());
            $newDeck->setArkPositions($iDeck->getArkPositionsToArray());

            $newDecks[] = $newDeck;
        }

        $iArkPhases = $this->getDoctrine()->getRepository('MirageUserBundle:IArkPhase')->loadByIdPlayerForDeck($player->getId());
//        $iArkPhases = $this->getDoctrine()->getRepository('MirageUserBundle:IArkPhase')->findByIdPlayer($player->getId());
        foreach($iArkPhases as $phase)
        {
            $phase->useInfo();
        }
        $arkPhaseMasters = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Ark')->findOnePhasesByIdPhases($iArkPhases);
        $arkMasters = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Ark')->findOneArkByIdPhases($iArkPhases);

        foreach($arkPhaseMasters as $arkPhaseInfo)
        {
            $arkPhaseInfo->deleteId();
        }
        foreach($arkMasters as $arkMaster){ $arkMaster->deleteId();}
        $result = array(
            'iDecks' => $newDecks,
            'iArkPhases' => $iArkPhases,
            'arkPhaseInfos' => $arkPhaseMasters,
            'arkInfos'=>$arkMasters,
        );
        return new Response($this->objectToJson($result));
    }

    /**
     * @Route("/save", name="save_deck")
     */
    public function saveDeckAction(Request $request)
    {
        $token = $request->get('token');
        $player = $this->getPlayer($token);
        $deckNumber = $request->get('deckNumber');
        $_positionsString = $request->get('positions');
        $positions = split('_',$_positionsString);
        $em = $this->getDoctrine()->getManager('user1_admin');
        $iDeck = $em->getRepository('MirageUserBundle:IDeck')->findOneBy(array('idPlayer'=>$player->getId(), 'deckNumber'=> $deckNumber));
        if(empty($iDeck)){
            $iDeck = new IDeck();
            $iDeck->setDeckNumber($deckNumber);
            $iDeck->setCreated($this->nowTime());
            $iDeck->setUpdated($this->nowTime());
            $iDeck->setIsEnabled(true);
            $em->persist($iDeck);
        }

        $iDeck->unsetAllPosition();
        foreach($positions as $pos => $arkPhaseId){
            if(!empty($arkPhaseId) && $arkPhaseId > 0){
                $iArkPhase = $em->getRepository('MirageUserBundle:IArkPhase')->find($arkPhaseId);
                if(isset($iArkPhase) && $iArkPhase->getIdPlayer()== $player->getId()){
                    $iDeck->setPositionAsKey($pos, $iArkPhase);
                }
            }
            else
            {
                $iDeck->setPositionAsKey($pos,null);
            }
        }

//        $em->clear();
        $em->flush();

//       return new Response();
        return $this->forward('MirageUserBundle:Deck:getDeck', array("request"=> $request));
    }


    /**
     * @Route("/phaseToggle", name="toggle_phases")
     */
    public function TogglePhaseStateAction(Request $request)
    {
        $token = $request->get('token');
        $_listFavoraitIdPhases = $request->get('listFavoraitIdPhases');
        $_listNewIdPhases = $request->get('listNewIdPhases');

        $nextAction = $request->get('nextAction');
        $player = $this->getPlayer($token);
        $listFavoraitPhases = split('_',$_listFavoraitIdPhases);
        $listNewPhases = split('_',$_listNewIdPhases);

        $em = $this->getDoctrine()->getManager('user1_admin');
        $iArkPhases =$em->getRepository('MirageUserBundle:IArkPhase')->loadByIdPlayerForDeck($player->getId());
        foreach($iArkPhases as $phase)
        {
            foreach($listFavoraitPhases as $item)
            {
                if($phase->getId() == $item)
                {
                    $phase->setIsFavored(!$phase->isIsFavored());
                    $em->persist($phase);
                }

            }
            foreach($listNewPhases as $item)
            {
                if($phase->getId() == $item)
                {
                    $phase->setIsFavored(!$phase->isIsFavored());
                    $em->persist($phase);
                }

            }
        }

        $em->flush();
        $em->clear();

        return $this->forward('MirageUserBundle:Deck:'.$nextAction, array("request"=> $request));
      //  return $this->redirect($this->generateUrl($nextAction, array("request"=> $request),307));
    }

    /**
     * @Route("/teamEffectAll", name="get_teamEffect")
     */
    public function getTeamEffectAction(Request $request){

        $result = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:TeamEffect')->findAll();
        return new Response($this->objectToJson($result));
    }

    /**
     * @Route("/masterArk", name="get_masterArk")
     */
    public function getMasterArkInfoAction(Request $request)
    {
        $result = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Ark')->findAll();
        foreach($result as $item)
        {
            $item->deleteId();
        }
        return new Response($this->objectToJson($result));
    }

    /**
     * @Route("/playerDeck", name="get_playerDeck")
     */
    public function getPlayerArkInfoAction(Request $request)
    {

        $token = $request->get('token');
        $player = $this->getPlayer($token);
        $iDecks = $this->getDoctrine()->getRepository('MirageUserBundle:IDeck')->findByIdPlayer($player->getId());
        $newDecks = null;
        foreach($iDecks as $iDeck){
            $newDeck = new IDeck();
//            $iDeck->unsetPlayer();
            $newDeck->unsetDBInfo();
            $newDeck->setDeckNumber($iDeck->getDeckNumber());
            $newDeck->setArkPositions($iDeck->getArkPositionsToArray());

            $newDecks[] = $newDeck;
        }

        $iArkPhases = $this->getDoctrine()->getRepository('MirageUserBundle:IArkPhase')->loadByIdPlayerForDeck($player->getId());
       foreach($iArkPhases as $phase)
        {
            $phase->useInfo();
        }

        $result = array(
            'iDecks' => $newDecks,
            'iArkPhases' => $iArkPhases,
        );
        return new Response($this->objectToJson($result));
    }
}