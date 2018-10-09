<?php
/**
 * Created by PhpStorm.
 * User: Krsanika
 * Date: 2016-03-09
 * Time: 오후 6:10
 */

namespace Mirage\AdminBundle\Controller;

use Mirage\MainBundle\Document\Equipment;
use Mirage\UserBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Mirage\AdminBundle\Form\Type\EquipmentType;

class EquipmentController extends Controller
{
    /**
     * @Route("/", name="equipment_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $equipmentAll = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Equipment')->findAll();
        $id = $request->get('id');
        $editEquipment = null;
        $formView = null;

/*        $digit = sprintf('%04d', 3);
        $codes = explode("_", "EQUIP_NAME");

        $key = $codes[0]."_".$digit."_".$codes[1];
        var_dump($key);
*/

        if (isset($id)) {
            if($id == 0) $editEquipment = new Equipment();
            else $editEquipment = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Equipment')->findOneByIdEquipment((int)$id);


            $editForm = $this->createForm(EquipmentType::class, $editEquipment);
            $formView = $editForm->createView();
            $editForm->handleRequest($request);
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                // ... perform some action, such as saving the task to the database
                $equipment = $editForm->getData();
                $dm = $this->get('doctrine_mongodb')->getManager();
                $dm->persist($equipment);
                $dm->flush();
                return $this->redirectToRoute('equipment_index');
            }

        }
        return array("equipmentAll" => $equipmentAll, 'editEquipment'=>$editEquipment, 'form'=>$formView);
    }

}