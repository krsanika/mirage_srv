<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-23
 * Time: 오전 8:20
 */

namespace Mirage\AdminBundle\Form\Type;


use Doctrine\Common\Cache\ArrayCache;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\ODM\MongoDB\Types\StringType;
use Mirage\MainBundle\Document\RewardArks;
use Mirage\MainBundle\Document\RewardEquipments;
use Mirage\MainBundle\Document\RewardItems;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Mirage\AdminBundle\Form\Type\RewardItemType;
use Mirage\AdminBundle\Form\Type\RewardEquipmentType;
use Mirage\AdminBundle\Form\Type\RewardArkType;

class RewardOmitType extends AbstractType
{
//ArkType.php -> Phase 참조하면서 작성하면 될 듯 함.
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idReward', IntegerType::class, array('label' => '리워드ID'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\Reward'
//            'choices' => array(
//                'm' => 'Male',
//                'f' => 'Female',
//            )
        ));
    }

    public function getName(){
        return 'reward';
    }

//    public function getParent()
//    {
//        return ChoiceType::class;
//    }

}