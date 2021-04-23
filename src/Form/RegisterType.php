<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'row_attr' => [
                    'required' => true
                ],
            ])
            ->add('lastname', TextType::class, [
                'row_attr' => [
                    'required' => true
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'row_attr' => [
                    'required' => true
                ],
            ])
            ->add('avatar', FileType::class, [
                'attr' => [
                    'enctype' => 'multipart/form-data'
                ],
                'row_attr' => [
                    'required' => true
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/gif',
                            'image/png',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file',
                    ])
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type' => 'password',
                'first_name' => 'pass',
                'second_name' => 'confirm',
                'invalid_message' => 'Your password dont match.',
                'row_attr' => [
                    'type' => 'password',
                    'required' => true,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
