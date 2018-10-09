<?php
/**
 * Created by PhpStorm.
 * User: Krsanika
 * Date: 2017-02-27
 * Time: 오후 9:21
 */

namespace Mirage\AdminBundle\Form\Type;

use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Mirage\MainBundle\Game\GameConfig;


class SkillLevelEffectType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('target', ChoiceType::class, array('choices' => array_flip(GameConfig::$SKILL_TARGET), 'label' => "타겟　　", 'attr'=>['class'=>"target"]))
            ->add('effectContents', CollectionType::class, array('entry_type' => SkillLevelEffectContentType::class,'allow_add'=>true, 'allow_delete'=>true, 'prototype'=>true, 'entry_options' => array('required' => false, 'attr' => array('class' => 'effectBox')), 'label' => "내용　　",'required'=>false));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\SkillLevelEffect'
//            'choices' => array(
//                'm' => 'Male',
//                'f' => 'Female',
//            )
        ));
    }

    public function getName()
    {
        return 'skillLevelEffect';
    }
//    public function getParent()
//    {
//        return ChoiceType::class;
//    }

}