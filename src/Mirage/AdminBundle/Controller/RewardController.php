<?php
/**
 * Created by PhpStorm.
 * User: Krsanika
 * Date: 2016-03-09
 * Time: 오후 6:10
 */

namespace Mirage\AdminBundle\Controller;

use Mirage\MainBundle\Document\Reward;
use Mirage\UserBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Mirage\AdminBundle\Form\Type\RewardType;

class RewardController extends Controller
{
    /**
     * @Route("/", name="reward_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $rewardAll = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Reward')->findAll();
        $id = $request->get('id');
        $editReward = null;
        $formView = null;

/*        $digit = sprintf('%04d', 3);
        $codes = explode("_", "EQUIP_NAME");

        $key = $codes[0]."_".$digit."_".$codes[1];
        var_dump($key);
*/

        if (isset($id)) {
            if($id == 0) $editReward = new Reward();
            else $editReward = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Reward')->findOneByIdReward((int)$id);


            $editForm = $this->createForm(RewardType::class, $editReward);
            $formView = $editForm->createView();
            $editForm->handleRequest($request);
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                var_dump(23);
                // ... perform some action, such as saving the task to the database
                $reward = $editForm->getData();
                $dm = $this->get('doctrine_mongodb')->getManager();
                $dm->persist($reward);
                $dm->flush();
                return $this->redirectToRoute('reward_index');
            }

        }
        return array("rewardAll" => $rewardAll, 'editReward'=>$editReward, 'form'=>$formView);
    }

}