<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-23
 * Time: 오전 8:20
 */

namespace Mirage\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Mirage\AdminBundle\Form\Type\ShopProductType;

class ShopType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idShop', IntegerType::class, array('label'=> "번호　"))
            ->add('products',CollectionType::class, array('entry_type' => ShopProductType::class, /*'allow_add'=>true, 'allow_delete'=>true, 'prototype'=>true,*/ 'entry_options' => array('required'=> false, 'attr'=> array('class' => 'levelBox')), 'label'=>"레벨", 'required'=>false))
            ->add('startDay', IntegerType::class, array('label'=> "지연　", 'required'=>false ))
            ->add('endDay', IntegerType::class, array('label'=> "소모　", 'required'=>false))
            ->add('save', SubmitType::class, array('label' => '저장'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\Shop'
//            'choices' => array(
//                'm' => 'Male',
//                'f' => 'Female',
//            )
        ));
    }

    public function getName(){
        return 'shop';
    }
//    public function getParent()
//    {
//        return ChoiceType::class;
//    }

}