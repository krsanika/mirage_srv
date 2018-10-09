<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-09
 * Time: 오후 6:10
 */

namespace Mirage\AdminBundle\Controller;

use Mirage\UserBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DomCrawler\Crawler;

class DealController extends Controller
{
    /**
     * @Route("/", name="deal_index")
     * @Template()
     */
    public function indexAction()
    {
        $arkAll = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Ark')->findAll();
        $skillAll =  $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Skill')->findAll();


        return array('arkAll'=>$arkAll, 'skillAll'=>$this->ObjectToJson($skillAll));
    }

    /**
     * @Route("/", name="deal_result")
     * @Template()
     */
    public function resultAction(){

        return array();
    }
}