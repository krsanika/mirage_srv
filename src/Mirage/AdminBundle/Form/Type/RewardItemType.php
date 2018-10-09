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
use Mirage\AdminBundle\Form\Type\ItemOmitType;



class RewardItemType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('item', ItemOmitType::class, array('required'=> false, 'label'=>false))
        ->add('amount', IntegerType::class, array('label'=> "수량　　"));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\RewardItem'
//            'choices' => array(
//                'm' => 'Male',
//                'f' => 'Female',
//            )
        ));
    }

    public function getName(){
        return 'rewardItem';
    }
//    public function getParent()
//    {
//        return ChoiceType::class;
//    }

}