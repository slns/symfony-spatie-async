<?php

namespace App\Form;

use App\Entity\Landing;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LandingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Title',
                'attr' => ['placeholder' => 'Enter the title'],
            ])
            ->add('path', TextType::class, [
                'label' => 'Path',
                'attr' => ['placeholder' => 'Enter the path'],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Content',
                'required' => false,
                'attr' => ['placeholder' => 'Enter a content (optional)'],
            ])
            ->add('createdAt', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Creation Date',
                'disabled' => true,
            ])
            ->add('updatedAt', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Update Date',
                'required' => false,
                'disabled' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Landing::class,
            'attr' => ['novalidate' => 'novalidate'],
        ]);
    }
}
