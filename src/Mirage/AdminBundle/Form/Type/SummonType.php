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
use Mirage\AdminBundle\Form\Type\SummonModeType;
use Mirage\AdminBundle\Form\Type\SummonTableType;
use Mirage\MainBundle\Game\GameConfig;


class SummonType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idSummon', IntegerType::class, ['label'=> "번호　　"])
            ->add('idOrigin', ChoiceType::class, ['choices'=>array_flip(GameConfig::$ORIGINSTR_KR), 'label'=> "원작　　", 'required'=>true])
            ->add('targetType', ChoiceType::class, ['choices'=>array_flip(GameConfig::$SUMMON_TARGET_REPOSITORY_STR), 'label'=> "종류　　", 'required'=>true ])
            ->add('summonModes', CollectionType::class, ['entry_type' => SummonModeType::class, 'allow_add'=>true, 'allow_delete'=>true, 'prototype'=>true, 'entry_options' => array('required'=> false, 'attr'=> array('class' => 'levelBox')), 'label'=>"모드　　", 'required'=>false])
            ->add('summonTables',CollectionType::class, ['entry_type' => SummonTableType::class, 'allow_add'=>true, 'allow_delete'=>true, 'prototype'=>true, 'entry_options' => array('required'=> false, 'attr'=> array('class' => 'levelBox')), 'label'=>"테이블　", 'required'=>false])
            ->add('save', SubmitType::class, array('label' => '저장'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\Summon'
//            'choices' => array(
//                'm' => 'Male',
//                'f' => 'Female',
//            )
        ));
    }

    public function getName(){
        return 'summon';
    }
//    public function getParent()
//    {
//        return ChoiceType::class;
//    }

}