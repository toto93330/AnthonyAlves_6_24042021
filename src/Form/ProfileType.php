<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('passwordold', PasswordType::class, [
                'mapped' => false,
                'required' => true,
                'label' => 'Your Actual Password',
            ])
            ->add('newpassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_name' => 'pass',
                'second_name' => 'confirm',
                'first_options'  => [
                    'label' => 'Password',

                ],
                'second_options' => [
                    'label' => 'Repeat Password',
                ],
                'mapped' => false,
                'required' => false,
            ])
            ->add('newfirstname', TextType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'First Name',
            ])
            ->add('newlastname', TextType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Last Name',
            ])
            ->add('newavatar', FileType::class, [
                'attr' => [
                    'class' => 'd-none'
                ],
                'mapped' => false,
                'required' => false,
                'label' => 'Avatar',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
