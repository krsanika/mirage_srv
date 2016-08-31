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
        $idPlayer = $request->get('id_player');
        $allStory = GMemcached::get('allStory');
        if(empty($allStory)){
            $allStory = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Story')->findAll();
            GMemcached::set('allStory', $allStory, 0);
        }
        foreach($allStory as $story){
            $story->unsetObjectId();
            foreach($story->getChapters() as $chapter){
                foreach($chapter->getEpisodes() as $episode) {
                    $oriEnc = $episode->getEncounter();
                    $encounter = new Encounter();
                    $encounter->setEncId($oriEnc->getEncId());
                    $encounter->setReward($oriEnc->getReward());
                    $encounter->setEnemyCount(count($oriEnc->getEnemyPositions()));
                    $encounter->remakeForStoryView();
                    $episode->setEncounter($encounter);
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

}