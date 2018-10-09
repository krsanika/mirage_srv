<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-09-05
 * Time: 오후 8:09
 */

namespace Mirage\AdminBundle\Controller;

use Mirage\UserBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Mirage\MainBundle\Document\Shop;
use Mirage\AdminBundle\Form\Type\ShopType;
class ShopController extends Controller
{
    /**
     * @Route("/", name="shop_index")
     * @Template()
     */
    public function indexAction(Request $request){
        $shopAll = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Shop')->findAll();
        $editShop = null;
        $formView = null;
        $id = $request->get('id');
        if(isset($id)){
            if($id == 0) $editShop = new Shop();
            else{
                $editShop = $this->get('doctrine_mongodb')->getRepository('MirageMainBundle:Shop')->findOneByIdShop((int)$id);
            }



            $editForm = $this->createForm(ShopType::class, $editShop);
            $formView = $editForm->createView();
            $editForm->handleRequest($request);
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                // ... perform some action, such as saving the task to the database
                $shop = $editForm->getData();



                $dm = $this->get('doctrine_mongodb')->getManager();
                $dm->persist($shop);
                $dm->flush();
                return $this->redirectToRoute('shop_index');
            }

        }



        return ['shopAll'=> $shopAll, 'editShop'=> $editShop, 'form'=>$formView];

    }



}