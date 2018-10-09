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
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Mirage\AdminBundle\Form\Type\AlterSkillType;


class EnemyModifyType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idEnemy', IntegerType::class, array('label'=>'에너미ID'))
            ->add('hp', IntegerType::class, array('label'=>'HP　　　'))
            ->add('atk', IntegerType::class, array('label'=>'ATK　　'))
            ->add('def', IntegerType::class, array('label'=>'DEF　　'))
            ->add('agi', IntegerType::class, array('label'=>'AGI　　'))
            ->add('con', IntegerType::class, array('label'=>'CON　　'))
            ->add('skillActivate', IntegerType::class, array('label'=>'스킬개수'))
            ->add('alterSkill',CollectionType::class, array('entry_type' => AlterSkillType::class, 'entry_options' => array('attr'=> array('class' => 'phaseBox')), 'label'=>"얼터스킬"));

    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\EnemyModify'
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