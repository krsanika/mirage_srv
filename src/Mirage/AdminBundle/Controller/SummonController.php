<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-09-07
 * Time: 오전 3:46
 */

namespace Mirage\AdminBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Mirage\UserBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Mirage\MainBundle\Game\GameConfig;
use Mirage\MainBundle\Document\Summon;
use Mirage\AdminBundle\Form\Type\SummonType;

class SummonController extends Controller
{

    /**
     * @Route("/", name="summon_index")
     * @Template()
     */
    public function indexAction(Request $request){
        $allSummons = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Summon')->findAll();
        $id = $request->get('id');
        $editSummon = null;
        $formView = null;
        $rates = null;

        if(isset($id)){
            if($id == 0) $editSummon = new Summon();
            else{
                $editSummon = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Summon')->findOneByIdSummon((int)$id);
                $rates = $this->getSummonRate($editSummon);
            }
        }

        $editForm = $this->createForm(SummonType::class, $editSummon);
        $formView = $editForm->createView();
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // ... perform some action, such as saving the task to the database
            $summon = $editForm->getData();


            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($summon);
            $dm->flush();
            return $this->redirectToRoute('summon_index');
        }





        return array("allSummons" => $allSummons, "editSummon"=>$editSummon, 'form'=>$formView, 'rates'=>$rates);
    }

    /**
     * @Route("/testin", name="summon_testin")
     * @Template()
     */
    public function testinAction(){
        $allSummons = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Summon')->findAll();

        return ["allSummons"=>$allSummons];
    }

    /**
     * @Route("/test", name="summon_test")
     * @Template()
     */
    public function testAction(Request $request){
        $idSummon = (int)$request->get('id');
        $idMode = (int)$request->get('mode');
        $count = (int)$request->get('count');
        $summon =  $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Summon')->findOneByIdSummon($idSummon);
        $mode = $summon->getCurrentMode($idMode);
        $results = $this->summon($summon, $mode, $count);

        return array("results"=>$results);
    }


    public function summon($summon, $mode, $repeat){
        $results = array();
        $randMax = $summon->getTableRandMax($mode->getMinGrade());

        for($i=0; $i < $repeat; $i++){
            //TODO :: 랜덤픽 방식이 너무 단순함. 나중에 커스터마이징RAND할 것
            $rand = rand(1, $randMax);
            $randEndStr = $rand."/".$randMax;
            $base = 0;
            $grade = 0;
            foreach($summon->getSummonTables() as $table){
                if($mode->getMinGrade() > $table->getGrade()) continue;
                $base += $table->getGravity();
                if($rand < $base){
                    $grade = $table->getGrade();
                    break;
                }
            }
            $itemId = $table->getItems()[rand(1, count($table->getItems()))-1];

            $results[] = array("rendEndStr" => $randEndStr, "itemId"=> $itemId);

        }

        //아이템 찾아서 등록
        foreach($results as &$result) {
            switch ($summon->getTargetType()) {
                case GameConfig::SUMMON_TARGET_ARKPHASE:
                    $phase = $this->get('doctrine_mongodb')->getRepository(GameConfig::$SUMMON_TARGET_REPOSITORY_STR[GameConfig::SUMMON_TARGET_ARKPHASE])
                        ->findOnePhaseByIdPhase((int)$result['itemId']);
                    
                    $result['item'] = $phase;

                    break;
                case GameConfig::SUMMON_TARGET_EQUIPMENT:
                    break;
                case GameConfig::SUMMON_TARGET_ITEM:
                    break;
            }
        }


        return $results;
    }






}