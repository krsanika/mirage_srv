<?php
/**
 * Created by PhpStorm.
 * User: Krsanika
 * Date: 2017-07-26
 * Time: 오후 6:07
 */

namespace Mirage\UserBundle\Controller;

use Mirage\UserBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class GoogleController extends Controller
{

    /**
     * @Route("/register", name="google_register")
     */
    public function accountRegisterAction(Request $request){
//      http://1.229.95.138:9000/app_krsanika.php/user/google/register?uid=g1010101&email=dummy@gmail.com


    }


}