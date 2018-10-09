<?php
/**
 * Created by PhpStorm.
 * User: Krsanika
 * Date: 2016-03-09
 * Time: 오후 6:10
 */

namespace Mirage\AdminBundle\Controller;

use Mirage\MainBundle\Game\GameConfig;
use Mirage\UserBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Mirage\AdminBundle\Form\Type\EnemyType;

class EnemyController extends Controller
{
    /**
     * @Route("/", name="enemy_index")
     * @Template()
     */
    public function indexAction(Request $request){
        $enemyAll = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Enemy')->findAll();
        $id = $request->get('id');
        $editEnemy = null;
        $formView = null;
        if(!empty($id)){
            $editEnemy = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Enemy')->findOneByIdEnemy((int)$id);
            $editForm = $this->createForm(EnemyType::class, $editEnemy);
            $formView = $editForm->createView();
            $editForm->handleRequest($request);
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                // ... perform some action, such as saving the task to the database
                $enemy = $editForm->getData();
                $dm = $this->get('doctrine_mongodb')->getManager();
                $dm->persist($enemy);
                $dm->flush();
                return $this->redirectToRoute('enemy_index');
            }

        }
        return array("enemyAll" => $enemyAll, 'editEnemy'=>$editEnemy, 'form'=>$formView, 'tags'=>GameConfig::$TAGSTR_KR);
    }


    public function searchAction(Request $request){
        $enemyAll = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Enemy')->findAll();
        //  var_dump(print_r($enemyAll[0]->getPhases()));

        $id = $request->get('id');
        if(!empty($id)){
            $editEnemy = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Enemy')->findOneByEnemyId((int)$id);
            $editForm = $this->createForm(EnemyType::class, $editEnemy);
            $formView = $editForm->createView();
            $editForm->handleRequest($request);
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                // ... perform some action, such as saving the task to the database
                $enemy = $editForm->getData();
                $dm = $this->get('doctrine_mongodb')->getManager();
                $dm->persist($enemy);
                $dm->flush();
                return $this->redirectToRoute('enemy_index');
            }

        }
        return array("enemyAll" => $enemyAll, 'editEnemy'=>$editEnemy, 'form'=>$formView, 'tags'=>GameConfig::$TAGSTR_KR);
    }
}