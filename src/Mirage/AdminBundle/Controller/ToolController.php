<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-09
 * Time: 오후 6:10
 */

namespace Mirage\AdminBundle\Controller;

use Mirage\AdminBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ToolController extends Controller
{
    /**
     * @Route("/", name="tool_index")
     * @Template()
     */
    public function indexAction(){

        return array();
    }
}