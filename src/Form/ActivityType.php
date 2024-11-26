<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\Category;
use App\Entity\Subcategory; 
use App\Entity\ActivityBBDD;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Doctrine\ORM\EntityRepository;

class ActivityType extends AbstractType
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
            'mapped' => true,
            'attr' => ['class' => 'category-select'],
            ])
            ->add('subcategory', EntityType::class, [
                'class' => Subcategory::class,
                'choice_label' => 'name', 
                'label' => 'Subcategoría',
                'placeholder' => 'Seleccione una subcategoría',
                'mapped' => true,  // Se mapeará directamente a la entidad Activity
                'required' => false,
                'attr' =>['class' => 'subcategory-select'],
                
                'query_builder'=> function (EntityRepository $er){
                    return $er->createQueryBuilder('c');
                          
            },
            ])
            ->add('activityBBDD', EntityType::class,[
                'class'=>ActivityBBDD::class,
                'choice_label'=> 'name',
                'label'=> 'Lista de Actividades',
                'placeholder'=> 'Seleccione una actividad',
                'mapped'=> true,
                'required'=>false,
                'attr'=>['class'=> 'activityBBDD-select'],
                
                
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Fecha de la actividad',
            ])
            ->add('imagenes', CollectionType::class, [
                'entry_type' => FileType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'mapped' => false, 
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
