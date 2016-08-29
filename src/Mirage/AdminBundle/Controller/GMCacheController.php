<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-08-28
 * Time: 오후 11:53
 */

namespace Mirage\AdminBundle\Controller;
use Mirage\AdminBundle\Controller\Controller;
use Mirage\UserBundle\Services\GMemcached;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class GMCacheController extends Controller
{
    /**
     * @Route("/", name="cache_index")
     * @Template()
     */
    function IndexAction(){



    }
}