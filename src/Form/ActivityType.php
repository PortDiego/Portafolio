<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\Category;
use App\Entity\Subcategory; 
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', EntityType::class, [
                'class' => Category:: class,
                'choice_label' => 'name_cat',
                'placeholder' => 'Selecciona una categoria',
                'mapped' => true,
                'required' => true,
            ])
            ->add('subcategory', EntityType::class, [
                'class' => Subcategory::class,
                'choice_label' => 'name', 
                'label' => 'Subcategoría',
                'placeholder' => 'Seleccione una subcategoría',
                'mapped' => true,  // Se mapeará directamente a la entidad Activity
                'required' => false,
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Fecha de la actividad',
            ])
            ->add('imagenes', FileType::class, [
                'multiple'=>true,    //permite subir multiples imagenes
                'mapped' => false,   // No mapea directamente a una entidad
                'required' => false, // Es opcional
                'by_reference' => false,
            ]);
    }   

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Activity::class,
        ]);
    }
}
