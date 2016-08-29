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
use Symfony\Component\HttpFoundation\Request;
use Mirage\AdminBundle\Form\Type\ArkType;
use Mirage\AdminBundle\Controller\GameConfig;

class ArkController extends Controller
{
    /**
     * @Route("/", name="ark_index")
     * @Template()
     */
    public function indexAction(Request $request){
        $arkAll = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Ark')->findAll();
      //  var_dump(print_r($arkAll[0]->getPhases()));

        $id = $request->get('id');
        $editArk = null;
        $formView = null;
        if(!empty($id)){
            $editArk = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Ark')->findOneByArkId((int)$id);
            $editForm = $this->createForm(ArkType::class, $editArk);
            $formView = $editForm->createView();
            $editForm->handleRequest($request);
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                // ... perform some action, such as saving the task to the database
                $ark = $editForm->getData();
                $dm = $this->get('doctrine_mongodb')->getManager();
                $dm->persist($ark);
                $dm->flush();
                return $this->redirectToRoute('ark_index');
            }

        }
        return array("arkAll" => $arkAll, 'editArk'=>$editArk, 'form'=>$formView, 'tags'=>GameConfig::$TAGSTR_KR);
    }


    public function searchAction(Request $request){
        $arkAll = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Ark')->findAll();
        //  var_dump(print_r($arkAll[0]->getPhases()));

        $id = $request->get('id');
        if(!empty($id)){
            $editArk = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Ark')->findOneByArkId((int)$id);
            $editForm = $this->createForm(ArkType::class, $editArk);
            $formView = $editForm->createView();
            $editForm->handleRequest($request);
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                // ... perform some action, such as saving the task to the database
                $ark = $editForm->getData();
                $dm = $this->get('doctrine_mongodb')->getManager();
                $dm->persist($ark);
                $dm->flush();
                return $this->redirectToRoute('ark_index');
            }

        }
        return array("arkAll" => $arkAll, 'editArk'=>$editArk, 'form'=>$formView, 'tags'=>GameConfig::$TAGSTR_KR);
    }
}