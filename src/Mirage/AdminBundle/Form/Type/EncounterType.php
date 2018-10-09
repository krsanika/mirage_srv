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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Mirage\AdminBundle\Form\Type\EncounterTileType;
use Mirage\AdminBundle\Form\Type\EncounterTriggerType;
use Mirage\AdminBundle\Form\Type\RewardOmitType;


class EncounterType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idEnc', IntegerType::class, ['label'=>'조우ID　'])
            ->add('idBgNear', IntegerType::class, ['label'=>'근경　　'])
            ->add('idBgMid', IntegerType::class, ['label'=>'중경　　'])
            ->add('idBgFar', IntegerType::class, ['label'=>'원경　　'])
            ->add('speedBgNear', IntegerType::class, ['label'=>'근경속도'])
            ->add('speedBgMid', IntegerType::class, ['label'=>'중경속도'])
            ->add('speedBgFar', IntegerType::class, ['label'=>'원경속도'])
            ->add('idTile', IntegerType::class, ['label'=>'바닥재ID'])
            ->add('idBgm', IntegerType::class, ['label'=>'브금ID　'])
            ->add('mapLength', IntegerType::class, ['label'=>'맵길이　'])
            ->add('startDay', IntegerType::class, ['label'=>'개봉일　', 'required'=>false])
            ->add('endDay', IntegerType::class, ['label'=>'마감일　', 'required'=>false])
            ->add('tiles', CollectionType::class, ['entry_type'=>EncounterTileType::class, 'entry_options'=>[], 'allow_add'=>true, 'allow_delete'=>true, 'prototype'=>true, 'by_reference'=>false ])
            ->add('triggers', CollectionType::class, ['entry_type'=>EncounterTriggerType::class, 'entry_options'=>[], 'allow_add'=>true, 'allow_delete'=>true, 'prototype'=>true, 'by_reference'=>false   ])
            ->add('reward', RewardOmitType::class, ['label'=>false] )
            ->add('isEnabled', ChoiceType::class, array('choices'=>["공개"=>true, "비공개"=>false], 'expanded'=>true, "multiple"=>false, 'label'=>false))
            ->add('save', SubmitType::class, array('label' => '조우 저장'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\Encounter'
//            'choices' => array(
//                'm' => 'Male',
//                'f' => 'Female',
//            )
        ));
    }

    public function getName(){
        return 'encounter';
    }
//    public function getParent()
//    {
//        return ChoiceType::class;
//    }

}