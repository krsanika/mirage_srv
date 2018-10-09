<?php
/**
 * Created by PhpStorm.
 * User: Krsanika
 * Date: 2017-02-27
 * Time: 오후 9:21
 */

namespace Mirage\AdminBundle\Form\Type;

use Mirage\MainBundle\Game\GameConfig;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SkillLevelEffectContentType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('chance', IntegerType::class, array('label' => "적용확률"))
            ->add('type', ChoiceType::class, array('choices' => array_flip(GameConfig::$SKILL_TYPE), 'label' => "적용종류", 'required'=>false, 'attr'=>['class'=>"type"]))
            ->add('area', ChoiceType::class, array('choices' => array_flip(GameConfig::$SKILL_AREA), 'label' => "적용범위", 'required'=>false))
            ->add('volume', IntegerType::class, array('label' => "적용량　", 'required'=>false))
            ->add('duration', IntegerType::class, array('label' => "적용시한", 'required'=>false))
            ->add('delay', IntegerType::class, array('label' => "딜레이　", 'required'=>false, 'attr'=>['class'=>"delay"]))
            ->add('idCondition', ChoiceType::class, array('choices' => array_flip(GameConfig::$CONDITION), 'label' => "상태부여", 'required'=>false, 'attr'=>['class'=>"idCondition"]))
            ->add('idSubject', IntegerType::class, array('label' => "대상자ID", 'required'=>false, 'attr'=>['class'=>"idSubject"]));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\SkillLevelEffectContent'
//            'choices' => array(
//                'm' => 'Male',
//                'f' => 'Female',
//            )
        ));
    }

    public function getName()
    {
        return 'skillLevelEffectContent';
    }
//    public function getParent()
//    {
//        return ChoiceType::class;
//    }

}