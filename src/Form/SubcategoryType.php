<?php

namespace App\Form;

use App\Entity\Subcategory;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SubcategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name_sub', TextType::class, [
                'label' => 'Name of the Subcategory',
                'attr' => ['placeholder' => 'Enter the name of the subcategory']
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name_cat',
                'label' => 'Category',
                'placeholder' => 'Select a Category',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Subcategory::class,
        ]);
    }
}
