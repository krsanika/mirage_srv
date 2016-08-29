<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2016-08-29
 * Time: 오전 2:49
 */

namespace Mirage\AdminBundle\Controller;

use Mirage\UserBundle\Controller\Controller;
use Mirage\UserBundle\Services\GMemcached;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Memcache;


class GMemcacheController extends Controller
{

    /**
     * @Route("/", name="cache_index")
     * @Template()
     */
    public function IndexAction(){
        global $kernel;
        $memcache = new Memcache;
        $memcache->connect($kernel->getContainer()->getParameter('memcache_host'), $kernel->getContainer()->getParameter('memcache_port'));
        $stats = $memcache->getExtendedStats();
        return array("stats"=>$stats);
    }


    /**
     * @Route("/loadArks", name="cache_load_arks")
     */
    public function loadArksAction(){
        $arks = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Ark')->findByIsEnabled(true);

        foreach($arks as $ark){
            GMemcached::set(GMemcached::PREFIX_ARK.$ark->getArkId(),$ark, 0);
        };
//        return new Response();
        return $this->redirect($this->generateUrl('cache_index'));
    }

    /**
     * @Route("/loadIArks", name="cache_load_i_arks")
     */
    public function loadIArksAction(){
        $iArks = $this->getDoctrine()->getManager('user1_readonly')->getRepository('MirageUserBundle:IArk')->findByIsEnabled(true);
        $iArkPhases = $this->getDoctrine()->getManager('user1_readonly')->getRepository('MirageUserBundle:IArkPhase')->findByIsEnabled(true);

        foreach($iArks as $iArk){
            GMemcached::set(GMemcached::PREFIX_I_ARK.$iArk->getId(),$iArk, 0);
        };
        foreach($iArkPhases as $iPhase){
            GMemcached::set(GMemcached::PREFIX_I_ARK_PHASE.$iPhase->getId(),$iPhase, 0);
        };
//        return new Response();
        return $this->redirect($this->generateUrl('cache_index'));
    }

    /**
     * @Route("/loadIDeck", name="cache_load_i_deck")
     */
    public function loadIDeckAction(){
        $iDecks = $this->getDoctrine()->getManager('user1_readonly')->getRepository('MirageUserBundle:IDeck')->findByIsEnabled(true);

        foreach($iDecks as $iDeck){
            GMemcached::set(GMemcached::PREFIX_I_DECK.$iDeck->getId(),$iDeck, 0);
        };
//        return new Response();
        return $this->redirect($this->generateUrl('cache_index'));
    }

    /**
     * @Route("/flushAll", name="cache_flush_all")
     */
    public function flushAllAction(){
        GMemcached::flushAll();

        return $this->redirect($this->generateUrl('cache_index'));
    }


}