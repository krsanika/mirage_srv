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

class WebSocketController extends Controller
{
    /**
     * @Route("/", name="ws_index")
     * @Template()
     */
    public function indexAction(Request $request){
        
        return array();
    }


}