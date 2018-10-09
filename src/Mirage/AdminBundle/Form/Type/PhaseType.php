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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Mirage\AdminBundle\Form\Type\SkillOmitType;
use Mirage\MainBundle\Game\GameConfig;

class PhaseType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idPhase', IntegerType::class, ['label'=>'페이즈ID'])
            ->add('type', ChoiceType::class, array('choices'=> array_flip(GameConfig::$TYPESTR_KR), 'label'=>'종류　　'))
            ->add('grade',ChoiceType::class, array('choices'=> array_flip(GameConfig::$GRADESTR_KR), 'label'=>'등급　　'))
            ->add('atk', IntegerType::class, array('label' => "공　　　", 'error_bubbling'=>true))
            ->add('def', IntegerType::class, array('label' => "방　　　"))
            ->add('agi', IntegerType::class, array('label' => "속　　　"))
            ->add('con', IntegerType::class, array('label' => "운　　　"))
            ->add('tags', CollectionType::class, array(
                'entry_type'=> ChoiceType::class,
//                'entry_type'=> IntegerType::class,
                'entry_options'=> [
                    'choices'=>array_flip(GameConfig::$TAGSTR_KR),
                'label'=> "태그　　",
                    'attr'=> ['class' => 'tagBox'],
//                    'expanded'=>true,
//                    'multiple'=>true,
//                    'mapped' => false,
                ],
            ))
            ->add('skills', CollectionType::class, array('entry_type'=> SkillOmitType::class, 'entry_options'=>['label'=>'']))
            ->add('isEnabled', ChoiceType::class, array('choices'=>["공개"=>true, "비공개"=>false], 'expanded'=>true, "multiple"=>false, 'label'=>'실장　　'));
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