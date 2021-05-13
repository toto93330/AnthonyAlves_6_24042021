<?php

namespace App\Form;

use App\Entity\Trick;
use App\Form\VideoType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdminTrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'admin-title',
                    'style' => 'font-size: 1em;'
                ]
            ])
            ->add('image_card', FileType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'd-none',
                ],
            ])
            ->add('content', TextareaType::class, [
                'attr' => [
                    'cols' => '30',
                    'rows' => '10'
                ],
            ])
            ->add('category')
            ->add('images', FileType::class, [
                'multiple' => 'true',
                'data_class' => null,
                'attr' => [
                    'class' => 'd-none'
                ],
                'mapped' => false,
                'required' => false,
            ])
            ->add('videos', CollectionType::class, [
                'entry_type' => VideoType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype'    => true,
                'label' => false,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
