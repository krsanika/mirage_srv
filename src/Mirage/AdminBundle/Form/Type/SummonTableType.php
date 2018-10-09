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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Mirage\MainBundle\Game\GameConfig;


class SummonTableType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('grade', ChoiceType::class, ['choices'=>array_flip(GameConfig::$GRADESTR_KR) ,'label'=> "등급　　", 'required'=>true ])
            ->add('gravity', IntegerType::class, ['label'=> "비중　　", 'required'=>true ])
            ->add('items', CollectionType::class, ['entry_type'=>IntegerType::class, 'label'=> "내용물　", 'required'=>true ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\SummonTable'
//            'choices' => array(
//                'm' => 'Male',
//                'f' => 'Female',
//            )
        ));
    }

    public function getName(){
        return 'summonTable';
    }
//    public function getParent()
//    {
//        return ChoiceType::class;
//    }

}