<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-09
 * Time: 오후 9:13
 */

namespace Mirage\MainBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Mirage\UserBundle\Controller\Controller;
use Mirage\MainBundle\Document\SpriteAnimation;


class SpriteController extends Controller
{
    /**
     * @Route("/animeData/{charaId}", name="sprite_animeData")
     * @Template()
     */
    function PostAnimeDataAction($charaId){

        $anime = $this->get('doctrine_mongodb')
            ->getRepository('MirageMainBundle:SpriteAnimation')
            ->find($charaId);
        if (!$anime){
            throw $this->createNotFoundException('No data for id'.$charaId);
        }

        return new Response(json_encode($anime));
    }

}