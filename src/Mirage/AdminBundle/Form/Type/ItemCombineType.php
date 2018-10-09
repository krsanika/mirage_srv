<?php
/**
 * Created by PhpStorm.
 * User: raihe
 * Date: 2017-03-19
 * Time: 오후 4:18
 */

namespace Mirage\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Mirage\MainBundle\Game\GameConfig;
class ItemCombineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idItem', IntegerType::class, array('label'=>"생성에 필요한 아이템"))
            ->add('count', IntegerType::class, array('label'=> "필요한 아이템의 갯수"));

    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\MainBundle\Document\ItemCombine'

        ));
    }

    public function getName(){
        return 'item_combine';
    }

}