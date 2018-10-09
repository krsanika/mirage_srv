<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-23
 * Time: 오전 8:20
 */

namespace Mirage\AdminBundle\Form\Type;


use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ODM\MongoDB\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ItemType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idItem', IntegerType::class, array('label'=>'아이템ID'))
                ->add('effect', IntegerType::class, array('label'=>'효과종류(HP인가 AP인가)'))
                ->add('effectSize', IntegerType::class, array('label'=>'효과량'))
                ->add('type', IntegerType::class, array('label'=>'아이템타입'))
                ->add('tier', IntegerType::class, array('label' => '등급'))
                ->add('material',IntegerType::class, array('label'=>'마테리얼'))
                ->add('combine',CollectionType::class, array('label'=>'조합식', 'entry_type' => ItemCombineType::class, 'entry_options' => array('required'=> false,'label'=>'아이템','attr'=>array('class'=>'combineBox'))))
                ->add('save', SubmitType::class, array('label' => '아이템 등록'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\Item'
//            'choices' => array(
//                'm' => 'Male',
//                'f' => 'Female',
//            )
        ));
    }

    public function getName(){
        return 'item';
    }

//    public function getParent()
//    {
//        return ChoiceType::class;
//    }

}