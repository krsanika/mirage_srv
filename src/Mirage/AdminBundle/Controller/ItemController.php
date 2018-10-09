<?php
/**
 * Created by PhpStorm.
 * User: Krsanika
 * Date: 2016-03-09
 * Time: 오후 6:10
 */

namespace Mirage\AdminBundle\Controller;

use Mirage\MainBundle\Document\Item;
use Mirage\UserBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Mirage\AdminBundle\Form\Type\ItemType;

class ItemController extends Controller
{
    /**
     * @Route("/", name="item_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $itemAll = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Item')->findAll();
        $id = $request->get('id');
        $editItem = null;
        $formView = null;

/*        $digit = sprintf('%04d', 3);
        $codes = explode("_", "EQUIP_NAME");

        $key = $codes[0]."_".$digit."_".$codes[1];
        var_dump($key);
*/

        if (isset($id)) {
            if($id == 0) $editItem = new Item();
            else $editItem = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Item')->findOneByIdItem((int)$id);

            $editForm = $this->createForm(ItemType::class, $editItem);
            $formView = $editForm->createView();
            $editForm->handleRequest($request);
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                // ... perform some action, such as saving the task to the database
                $item = $editForm->getData();
                $dm = $this->get('doctrine_mongodb')->getManager();
                $dm->persist($item);
                $dm->flush();
                return $this->redirectToRoute('item_index');
            }

        }
        return array("itemAll" => $itemAll, 'editItem'=>$editItem, 'form'=>$formView);
    }

}