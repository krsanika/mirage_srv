<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-09-05
 * Time: 오후 8:09
 */

namespace Mirage\AdminBundle\Controller;

use Mirage\UserBundle\Controller\Controller;
use Mirage\UserBundle\Services\GMemcached;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Mirage\MainBundle\Document\Encounter;

class DeckSettingController extends Controller
{
    /**
     * @Route("/", name="deck_index")
     * @Template()
     */
    public function indexAction(){


        return array();
    }


}