<?php
/**
 * Created by PhpStorm.
 * User: Krsanika
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
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Mirage\MainBundle\Game\GameConfig;


class EncounterTriggerType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idEvent', IntegerType::class, ['label'=>'이벤트ID'])
            ->add('type', IntegerType::class, ['label'=>'종류　　'])
            ->add('target', IntegerType::class, ['label'=>'대상　　']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\EncounterTrigger'
//            'choices' => array(
//                'm' => 'Male',
//                'f' => 'Female',
//            )
        ));
    }

    public function getName(){
        return 'encounterTrigger';
    }
//    public function getParent()
//    {
//        return ChoiceType::class;
//    }

}