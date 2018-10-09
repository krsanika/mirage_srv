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
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Mirage\MainBundle\Game\GameConfig;


class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', EmailType::class, array('label'=> "이메일　"))
            ->add('password', RepeatedType::class, array(
                'type'=>PasswordType::class,
                'invalid_message' => '패스워드가 일치하지 않습니다.',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'error_bubbling' => false,
                'first_options'  => array('label' => '비밀번호'),
                'second_options' => array('label' => '재입력　'),
            ))

            ->add('id_device', HiddenType::class, array('mapped'=> false))
            ->add('device_name', HiddenType::class, array('mapped'=> false))
            ->add('os_type', HiddenType::class, array('mapped'=> false))
            ->add('submit', SubmitType::class, array('label' => 'CBT계정 생성'));


    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Mirage\UserBundle\Entity\User'
//            'choices' => array(
//                'm' => 'Male',
//                'f' => 'Female',
//            )
        ));
    }

    public function getName(){
        return 'user';
    }
//    public function getParent()
//    {
//        return ChoiceType::class;
//    }

}