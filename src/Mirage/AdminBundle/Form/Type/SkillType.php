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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Mirage\AdminBundle\Form\Type\SkillLevelType;
use Mirage\MainBundle\Game\GameConfig;


class SkillType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idSkill', IntegerType::class, array('label'=> "번호　"))
            ->add('levels',CollectionType::class, array('entry_type' => SkillLevelType::class, /*'allow_add'=>true, 'allow_delete'=>true, 'prototype'=>true,*/ 'entry_options' => array('required'=> false, 'attr'=> array('class' => 'levelBox')), 'label'=>"레벨", 'required'=>false))
            ->add('consume', IntegerType::class, array('label'=> "소모　", 'required'=>false))
            ->add('idSource', ChoiceType::class, array('choices'=>array_flip(GameConfig::$POWER_SOURCE) ,'label' => "파워소스"))
            ->add('isMelee', ChoiceType::class, array('choices'=>["근"=>true, "원"=>false], 'label' => "레인지　",'expanded'=>true, "multiple"=>false, 'required'=>false))
            ->add('save', SubmitType::class, array('label' => '저장'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\Skill'
//            'choices' => array(
//                'm' => 'Male',
//                'f' => 'Female',
//            )
        ));
    }

    public function getName(){
        return 'skill';
    }
//    public function getParent()
//    {
//        return ChoiceType::class;
//    }

}