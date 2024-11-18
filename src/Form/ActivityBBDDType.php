<?php

namespace App\Form;

use App\Entity\ActivityBBDD;
use App\Entity\Provinces;
use App\Entity\Subcategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivityBBDDType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class)

        ->add('subcategory', EntityType::class, [
            'class' => Subcategory::class, 
            'choice_label' => 'name_sub',
            'placeholder' => 'Selecciona una subcategoría',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ActivityBBDD::class,
        ]);
    }
}
