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


class SummonModeType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idMode', IntegerType::class, ['label'=> "모드ID　", 'required'=>true ])
            ->add('billingType', ChoiceType::class, ['choices'=>array_flip(GameConfig::$CARGO_STR), 'label'=> "구입　　", 'required'=>true ])
            ->add('price', IntegerType::class, ['label'=> "가격　　", 'required'=>true ])
            ->add('drawCount', IntegerType::class, ['label'=> "회수　　", 'required'=>true ])
            ->add('minGrade', ChoiceType::class, ['choices'=>array_flip(GameConfig::$GRADESTR_KR), 'label'=> "최저성　", 'required'=>true ])
            ->add('isRepeat', ChoiceType::class, ['choices'=>["연챠"=>true, "단챠"=>false],'expanded'=>true, "multiple"=>false, 'label'=> "반복실행", 'required'=>true ])
            ->add('startDay', IntegerType::class, ['label'=> "공개일　　", 'required'=>true ])
            ->add('endDay', IntegerType::class, ['label'=> "종료일　　", 'required'=>true ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\SummonMode'
//            'choices' => array(
//                'm' => 'Male',
//                'f' => 'Female',
//            )
        ));
    }

    public function getName(){
        return 'summon';
    }
//    public function getParent()
//    {
//        return ChoiceType::class;
//    }

}