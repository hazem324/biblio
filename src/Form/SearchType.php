<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use App\Enums\Category;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
      
        ->add('search', TextType::class, [
            'label' => 'Search by Title', 
            'attr' => [
                'placeholder' => 'Enter title...', 
                'class' => 'search-input', 
            ],
        ])

        ->add('category', EnumType::class, [
            'class' => Category::class,
            'placeholder' => 'Select a category',
            'attr' => [
                'class' => 'category-select', 
            ],
        ])

        ->add('recherche', SubmitType::class, [
            'label' => 'Search',
            'attr' => [
                'class' => 'btn btn-search', 
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
