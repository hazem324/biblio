<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
      
        ->add('search', TextType::class, [
            'label' => 'Search by Title', // You can set the label you want
            'attr' => [
                'placeholder' => 'Enter title...', // Placeholder text
                'class' => 'search-input', // CSS class for styling
            ],
        ])
        // Add a submit button
        ->add('recherche', SubmitType::class, [
            'label' => 'Search',
            'attr' => [
                'class' => 'btn btn-search', // CSS class for styling
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
