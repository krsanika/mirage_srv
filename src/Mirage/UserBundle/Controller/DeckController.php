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
     * @Route("/", name="get_deck")
     */
    public function getDeckAction(Request $request){
//        $idPlayer = $request->get('id_player');
//        $iDecks = $this->getDoctrine()->getRepository('MirageUserBundle:IDeck')->findByIdPlayer($idPlayer);
//        foreach($iDecks as $iDeck){
//            $iDeck->unsetPlayer();
//            foreach($iDeck->getArkPos() as &$ark){
//                if(isset($ark)){
//                    $ark->unsetPlayer();
//                    $ark->setArk(GMemcached::get('Ark_'.$ark->getIdArk()));
//                }
//            }
//        }

//        var_dump(GMemcached::get('Ark_101'));

        $arks = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Ark')->findByIsEnabled(true);

        $result = array(
            'iDecks' => $arks[0]
        );
        return new Response($this->objectToJson($result));
    }


}