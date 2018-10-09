<?php
/**
 * Created by PhpStorm.
 * User: Krsanika
 * Date: 2016-03-23
 * Time: 오전 8:20
 */

namespace Mirage\AdminBundle\Form\Type;

use Mirage\MainBundle\Game\GameConfig;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Mirage\AdminBundle\Form\Type\EnemyOmitType;


class EncounterTileType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('location', TextType::class, ['label'=>'위치'])
            ->add('terrain', ChoiceType::class, ['choices'=>array_flip(GameConfig::$TERRAIN), 'label'=>"지형",  'required' =>false])
            ->add('enemy', EnemyOmitType::class, ['label'=>false, 'required' =>false]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\Tile'
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