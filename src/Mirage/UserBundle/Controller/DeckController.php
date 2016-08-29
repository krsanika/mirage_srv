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
use Mirage\UserBundle\Services\GMemcached;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Mirage\MainBundle\Document\Notification;

class DeckController extends Controller
{
    /**
     * @Route("/", name="getIDecks")
     */
    public function getIDecksAction(Request $request){
        $idPlayer = $request->get('id_player');
        $iDecks = $this->getDoctrine()->getRepository('MirageUserBundle:IDeck')->findByIdPlayer($idPlayer);
        foreach($iDecks as $iDeck){
            $iDeck->unsetPlayer();
            foreach($iDeck->getArkPos() as &$iArk){
                if(isset($iArk)){
                    $iArk->unsetPlayer();
                    $ark = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Ark')->findOneBy(array("isEnabled"=>true, "arkId"=>$iArk->getIdArk()));
                    $iArk->setArk($ark);
                }
            }
        }
        return new Response($this->objectToJson($iDecks));
    }

    /**
     * @Route("/change", name="change_deck")
     */
    public function changeDeckAction(Request $request){
        $idPlayer = $request->get('id_player');
        $idDeck =  $request->get('id_deck');
        $deckPos = $request->get('deckPos');





        return $this->redirect($this->generateUrl('getIDecks'));
//        return new Response(false);
    }


}