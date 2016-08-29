<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-23
 * Time: 오전 8:20
 */

namespace Mirage\AdminBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Mirage\AdminBundle\Controller\GameConfig;

class PhaseType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('phaseId', IntegerType::class)
            ->add('type', ChoiceType::class, array('choices'=> GameConfig::$TYPESTR_KR, 'label'=>'종류'))
            ->add('grade',ChoiceType::class, array('choices'=> GameConfig::$GRADESTR_KR, 'label'=>'등급'))
            ->add('name_kr', TextType::class, array('label' => "한국어명"))
            ->add('name_jp', TextType::class, array('label' => "일본어명"))
            ->add('atk', IntegerType::class, array('label' => "공", 'error_bubbling'=>true))
            ->add('def', IntegerType::class, array('label' => "방"))
            ->add('spd', IntegerType::class, array('label' => "속"))
            ->add('luk', IntegerType::class, array('label' => "운"))
            ->add('tags', CollectionType::class, array('entry_type'=> HiddenType::class,  'label'=> "태그", 'allow_add'=>true, 'allow_delete' =>true, 'attr'=> array('class' => 'tagBox')))
        ;
//            ->add('save', SubmitType::class, array('label' => '페이즈 등록'));

    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\Phase'
//            'choices' => array(
//                'm' => 'Male',
//                'f' => 'Female',
//            )
        ));
    }

    public function getName(){
        return 'phase';
    }

//    public function getParent()
//    {
//        return ChoiceType::class;
//    }

}