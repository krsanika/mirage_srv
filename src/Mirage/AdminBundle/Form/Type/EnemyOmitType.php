<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-03-23
 * Time: 오전 8:20
 */

namespace Mirage\AdminBundle\Form\Type;

use Guzzle\Common\Collection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Mirage\AdminBundle\Form\Type\ArkOmitType;
use Mirage\AdminBundle\Form\Type\EnemyModifyType;
use Mirage\MainBundle\Game\GameConfig;


class EnemyOmitType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idEnemy', IntegerType::class, array('label'=>"몹ID"));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\Enemy'
//            'choices' => array(
//                'm' => 'Male',
//                'f' => 'Female',
//            )
        ));
    }

    public function getName(){
        return 'enemy';
    }
//    public function getParent()
//    {
//        return ChoiceType::class;
//    }

}