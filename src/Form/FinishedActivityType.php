<?php

namespace App\Form;

use App\Entity\FinishedActivity;
use App\Entity\Category; 
use App\Entity\Subcategory;
use App\Entity\ActivityBBDD;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Doctrine\ORM\EntityRepository;

class FinishedActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', EntityType::class, [
                'class' => Category::class, 
                'choice_label' => 'name_cat', 
                'label' => 'Categoría',
                'placeholder' => 'Selecciona una Categoría', 
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                              ->where('c.active = :active')
                              ->setParameter('active', true);
                },
                'mapped' => false,
                'attr' => ['class' => 'category-select'],
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Fecha de la Actividad',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FinishedActivity::class,
        ]);
    }
}


