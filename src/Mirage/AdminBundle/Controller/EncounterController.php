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

class EncounterController extends Controller
{
    /**
     * @Route("/", name="encounter_index")
     * @Template()
     */
    public function indexAction(Request $request){
        $id = $request->get('id');
        $editEnc = null;
        if(!empty($id)){
            $editEnc = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Encounter')->findOneByEncId((int)$id);
        }

        $encs = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Encounter')->findAll();

        return array("encs"=>$encs, "editEnc"=>$editEnc);
    }



}