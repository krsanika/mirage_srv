<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-23
 * Time: 오전 8:20
 */

namespace Mirage\AdminBundle\Form\Type;

use Guzzle\Common\Collection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Mirage\AdminBundle\Form\Type\ArkOmitType;
use Mirage\AdminBundle\Form\Type\EnemyModifyType;
use Mirage\MainBundle\Game\GameConfig;


class EnemyType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idEnemy', IntegerType::class, array('label'=>'ID　　　'))
            ->add('ark',ArkOmitType::class, ['label'=>false])
            ->add('idPhase', IntegerType::class, array('label'=> "페이즈　"))
            ->add('lv', IntegerType::class, array('label'=> 'Lv　　　'))
            ->add('dressUp', IntegerType::class, array('label'=> '드레스　'))
            ->add('dignity', IntegerType::class, array('label'=> '품격　　'))
            ->add('modify', EnemyModifyType::class, array('label'=>false))
            ->add('equipments',CollectionType::class, array('entry_type' => EquipmentOmitType::class, 'entry_options' => array('required'=> false, 'attr'=> array('class' => 'phaseBox')), 'label'=>'장비　　'))
            ->add('save', SubmitType::class, array('label' => '저장'));


    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\Enemy'
//            'choices' => array(
//                'm' => 'Male',
//                'f' => 'Female',
//            )
        ));
    }

    public function getName(){
        return 'enemy';
    }
//    public function getParent()
//    {
//        return ChoiceType::class;
//    }

}