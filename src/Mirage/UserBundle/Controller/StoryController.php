<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-08-26
 * Time: 오후 6:41
 */

namespace Mirage\UserBundle\Controller;

use Mirage\UserBundle\Controller\Controller;
use Mirage\UserBundle\Services\GMemcached;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Mirage\MainBundle\Document\Encounter;

class StoryController extends Controller
{

    /**
     * @Route("/", name="story_progress")
     */
    public function ProgressAction(Request $request){
        $token = $request->get('token');

        $em = $this->getDoctrine()->getManager('user1_admin');
        $player = $this->getPlayer($token);
        $idPlayer = $player->getId();
      //  $allStory = GMemcached::get('allStory');
      //  if(empty($allStory)){
            $allStory = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Story')->findAllSortYear();
       //     GMemcached::set('allStory', $allStory, 0);
       // }
        foreach($allStory as &$year) {
            foreach ($year['stories'] as &$story) {
                $story->unsetObjectId();
                foreach ($story->getChapters() as &$chapter) {
                    foreach ($chapter->getEpisodes() as &$episode) {
                        $episode->trimForStoryView();
                    }
                }
            }
        }

        $iStory = $this->getDoctrine()->getRepository('MirageUserBundle:IStory')->findMyProgress($idPlayer);

        $result = array(
            'iStory' => $iStory,
            'allStory' => $allStory
        );

        return new Response($this->objectToJson($result) );
    }

    /**
     * @Route("/name", name="story_name")
     */
    public function changePlayerNameAction(Request $request){
        $token = $request->get('token');
        $name = $request->get('name');
        
        $token= $this->checkToken($token);
        //6글자일 때 튕김
        if(mb_strlen($name) > 6 || strpos($name, "/[ #\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i")){
            return new Response($this->objectToJson(false));
        }

        $em = $this->getDoctrine()->getManager('user1_admin');
        $user = $em->getRepository('MirageUserBundle:User')->findOneBySalt($token);
        if(empty($user)){
            return new Response($this->objectToJson(false));
        }
        $idPlayer = $user->getIdPlayer();
        $player = $em->getRepository('MirageUserBundle:Player')->find($idPlayer);
        $player->setName($name);
        $em->flush();
        return new Response($this->objectToJson(false));
    }


}