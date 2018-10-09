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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Mirage\AdminBundle\Form\Type\PhaseType;
use Mirage\MainBundle\Game\GameConfig;


class ArkType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idArk', IntegerType::class, ['label'=>'아크ID　'])
        ->add('title', ChoiceType::class, array('choices'=> array_flip(GameConfig::$TITLESTR_KR), 'label'=>"출전작　"))
        ->add('origin', ChoiceType::class, array('choices'=> array_flip(GameConfig::$ORIGINSTR_KR), 'label'=>"작가　　"))
        ->add('phases',CollectionType::class, array(
            'entry_type' => PhaseType::class,
            'label'=>"페이즈　",
            'entry_options' => array('required'=> false, 'attr'=> array('class' => 'phaseBox')),
        ))
        ->add('isEnabled', ChoiceType::class, array('choices'=>["공개"=>true, "비공개"=>false], 'expanded'=>true, "multiple"=>false, 'label'=>'아크실장'))
        ->add('save', SubmitType::class, array('label' => '저장'));


    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\Ark'
//            'choices' => array(
//                'm' => 'Male',
//                'f' => 'Female',
//            )
        ));
    }

    public function getName(){
        return 'ark';
    }
//    public function getParent()
//    {
//        return ChoiceType::class;
//    }

}