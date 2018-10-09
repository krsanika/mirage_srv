<?php
/**
 * Created by PhpStorm.
 * User: Krsanika
 * Date: 2017-02-27
 * Time: 오후 9:21
 */

namespace Mirage\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Mirage\MainBundle\Game\GameConfig;

class ShopProductType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idItem', IntegerType::class, array('label' => "잡템ID　", 'required'=>false))
            ->add('idEquipment', IntegerType::class, array('label' => "장비ID　", 'required'=>false))
            ->add('idArkphase', IntegerType::class, array('label' => "페이즈ID", 'required'=>false))
            ->add('currency', ChoiceType::class, array('choices'=>array_flip(GameConfig::$CARGO_STR),'label' => "화폐　　", 'required'=>false))
            ->add('cost', IntegerType::class, array('label' => "가격　　", 'required'=>false))
            ->add('stack', IntegerType::class, array('label' => "개수　　", 'required'=>false));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\ShopProduct'
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