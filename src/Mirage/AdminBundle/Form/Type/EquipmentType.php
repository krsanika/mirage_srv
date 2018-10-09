<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-23
 * Time: 오전 8:20
 */

namespace Mirage\AdminBundle\Form\Type;


use Mirage\MainBundle\Game\GameConfig;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class EquipmentType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idEquipment', IntegerType::class, array('label'=>'장비ID　'))
            ->add('effect', IntegerType::class, array('label'=>'효과종류'))
            ->add('volume',IntegerType::class, array('label'=>'효과량　'))
            ->add('tier', ChoiceType::class, array('choices'=> array_flip(GameConfig::$GRADESTR_KR), 'label' => '등급　　'))
            ->add('save', SubmitType::class, array('label' => '장비 등록'));
    }

    public function createForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idEquipment', IntegerType::class, array('label'=>'장비ID'))
            ->add('effect', IntegerType::class, array('label'=>'효과종류'))
            ->add('volume',IntegerType::class, array('label'=>'효과량　'))
            ->add('tier', IntegerType::class, array('label' => '등급　　'))
            ->add('save', SubmitType::class, array('label' => '장비 등록'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\Equipment'
//            'choices' => array(
//                'm' => 'Male',
//                'f' => 'Female',
//            )
        ));
    }

    public function getName(){
        return 'equipment';
    }

//    public function getParent()
//    {
//        return ChoiceType::class;
//    }

}