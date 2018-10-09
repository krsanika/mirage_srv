<?php
/**
 * Created by PhpStorm.
 * User: Krsanika
 * Date: 2017-02-27
 * Time: 오후 9:21
 */

namespace Mirage\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Mirage\AdminBundle\Form\Type\SkillLevelEffectType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;



class SkillLevelType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('lv', IntegerType::class, array('label'=> "LV　　", 'attr'=>array( 'class'=>'skillLv'), 'required'=>false ))
            ->add('effects',CollectionType::class, array('entry_type' => SkillLevelEffectType::class, 'allow_add'=>true, 'allow_delete'=>true, 'prototype'=>true, 'entry_options' => array('required'=> false, 'attr'=> array('class' => 'effectBox')), 'label'=>"효과　"));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\SkillLevel'
//            'choices' => array(
//                'm' => 'Male',
//                'f' => 'Female',
//            )
        ));
    }

    public function getName(){
        return 'skillLevel';
    }
//    public function getParent()
//    {
//        return ChoiceType::class;
//    }

}