<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-02-27
 * Time: 오후 6:07
 */

namespace Mirage\AdminBundle\Controller;

use Mirage\MainBundle\Game\GameConfig;
use Mirage\UserBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Mirage\AdminBundle\Form\Type\SkillType;
use Mirage\MainBundle\Document\Skill;
use Mirage\MainBundle\Document\SkillLevel;


class SkillController extends Controller
{
    /**
     * @Route("/", name="skill_index")
     * @Template()
     */
    public function indexAction(Request $request){
        $skillAll = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Skill')->findAll();
        $id = $request->get('id');
        $editSkill = null;
        $formView = null;
        if(isset($id)){
            if($id == 0) $editSkill = new Skill();
            else{
                $editSkill = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Skill')->findOneByIdSkill((int)$id);
                for($i = $editSkill->getLevels()->count()+1 ; $i < 11; $i++){
                    $editSkill->getLevels()->add(new SkillLevel($i));
                }
            }



            $editForm = $this->createForm(SkillType::class, $editSkill);
            $formView = $editForm->createView();
            $editForm->handleRequest($request);
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                // ... perform some action, such as saving the task to the database
                $skill = $editForm->getData();

                foreach($skill->getLevels() as &$level){
                    foreach($level->getEffects() as &$effect){
                        if ($level->getEffects()->count() != 1 && empty($effect->getTarget())){
                            $level->removeEffect($effect);
                            continue;
                        }
                        foreach($effect->getEffectContents() as &$content){
                            if($effect->getEffectContents()->count() != 1 && empty($content->getType()) && empty($content->getArea()) ){
                                $effect->removeEffectContent($content);
                                continue;
                            }
                        }
                    }
                }


                $dm = $this->get('doctrine_mongodb')->getManager();
                $dm->persist($skill);
                $dm->flush();
                return $this->redirectToRoute('skill_index');
            }

        }




        return array('skillAll'=> $skillAll, 'editSkill'=> $editSkill, 'form'=>$formView, 'types'=>GameConfig::$SKILL_TYPE, 'conditions'=>GameConfig::$CONDITION);
    }


    /**
     * @Route("/delete", name="skill_delete")
     * @Template()
     */
    public function deleteAction(Request $request){
        $id = $request->get('id');
        $dm = $this->get('doctrine_mongodb')->getManager();
        $deleteSkill = $dm->getRepository('MirageMainBundle:Skill')->findOneByIdSkill((int)$id);
        if(isset($deleteSkill))
            $dm->remove($deleteSkill);
        $dm->flush();

        return $this->redirectToRoute('skill_index');
    }


}