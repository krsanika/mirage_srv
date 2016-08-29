<?php
/**
 * Created by PhpStorm.
 * User: JF_WS00
 * Date: 2016-08-29
 * Time: 오전 2:49
 */

namespace Mirage\AdminBundle\Controller;

use Mirage\AdminBundle\Controller\Controller;
use Mirage\UserBundle\Services\GMemcached;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


class GMemcacheController extends Controller
{

    /**
     * @Route("/", name="cache_index")
     * @Template()
     */
    public function IndexAction(){


        return array();
    }


    /**
     * @Route("/loadArks", name="cache_load_arks")
     */
    public function loadArksAction(){
        $arks = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Ark')->findByIsEnabled(true);
        foreach($arks as $ark){
            GMemcached::set(GMemcached::PREFIX_ARK.$ark->getArkId(), $ark, 0);
        };


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