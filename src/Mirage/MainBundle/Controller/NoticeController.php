<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-09
 * Time: 오후 5:53
 */

namespace Mirage\MainBundle\Controller;

use Mirage\UserBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Mirage\MainBundle\Document\Notification;


class NoticeController extends Controller
{
    /**
     * @Route("/", name="notice_index")
     * @Template()
     */
    public function indexAction(){
//        $notice = new Notification();
//        $notice->setSubject('A Foo Bar');
//        $notice->setText('19.99');
//
//        $dm = $this->get('doctrine_mongodb')->getManager();
//        $dm->persist($notice);
//        $dm->flush();



        return array();
    }


}