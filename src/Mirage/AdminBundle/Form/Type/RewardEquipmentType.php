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
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Mirage\AdminBundle\Form\Type\EquipmentOmitType;



class RewardEquipmentType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('amount', IntegerType::class, array('label'=> "수량　　"))
            ->add('equipment', EquipmentOmitType::class, array('allow_extra_fields'=>true, 'required'=> false, 'attr'=> array('class' => 'effectBox'), 'label'=>false));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\RewardEquipment'
//            'choices' => array(
//                'm' => 'Male',
//                'f' => 'Female',
//            )
        ));
    }

    public function getName(){
        return 'equipmentLevel';
    }
//    public function getParent()
//    {
//        return ChoiceType::class;
//    }

}