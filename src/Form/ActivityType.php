<?php

namespace App\Form;

use App\Entity\Activity;
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
            ->add('subcategory', EntityType::class, [
                'class' => Subcategory::class,
                'choice_label' => 'nombre', 
                'label' => 'Subcategoría',
                'placeholder' => 'Seleccione una subcategoría',
            ])
            ->add('fecha', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Fecha de la actividad',
            ])
            ->add('imagenes', CollectionType::class, [
                'entry_type' => FileType::class,
                'entry_options' => ['label' => 'URL de la imagen'],
                'allow_add' => true,
                'allow_delete' => true,
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
