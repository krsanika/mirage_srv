<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-15
 * Time: 오전 12:57
 */

namespace Mirage\AdminBundle\Controller;

use Mirage\UserBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Mirage\AdminBundle\Form\Type\EncounterType;
use Mirage\MainBundle\Document\Encounter;

class EncounterController extends Controller
{
    /**
     * @Route("/", name="encounter_index")
     * @Template()
     */
    public function indexAction(Request $request){
        $encAll = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Encounter')->findAll();
        $id = $request->get('id');
        $editEnc = null;
        $formView = null;

        if(isset($id)){
            if($id == 0) $editEnc = new Encounter();
            else{
                $editEnc = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Encounter')->findOneByIdEnc((int)$id);
            }

            $editForm = $this->createForm(EncounterType::class, $editEnc);
            $formView = $editForm->createView();
            $editForm->handleRequest($request);
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                // ... perform some action, such as saving the task to the database
                $encounter = $editForm->getData();
                $dm = $this->get('doctrine_mongodb')->getManager();
                //new하면 캐스케이드해야하는듯.
                foreach($encounter->getTiles() as &$tile){
                    $enemy = $dm->getRepository('MirageMainBundle:Enemy')->findOneByIdEnemy((int)$tile->getEnemy()->getIdEnemy());
                    if(isset($enemy)){
                        $tile->setEnemy($enemy);
                    }else continue;
                }
                $reward = $dm->getRepository('MirageMainBundle:Reward')->findOneByIdReward((int)$encounter->getReward()->getIdReward());
                var_dump((int)$encounter->getReward()->getIdReward());
                $encounter->setReward($reward);
                /*
                foreach($encounter->getTriggers() as $trigger){
                    $dm->persist($trigger);
                }
                */
                $dm->merge($encounter);
                $dm->flush();
                return $this->redirectToRoute('encounter_index');
            }

        }
        return array("encAll" => $encAll, 'editEnc'=>$editEnc, 'form'=>$formView);
    }



}