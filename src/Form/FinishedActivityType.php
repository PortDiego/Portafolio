<?php

namespace App\Form;

use App\Entity\FinishedActivity;
use App\Entity\Category; 
use App\Entity\Subcategory;
use App\Entity\ActivityBBDD;
use App\Entity\Photo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            ])
            ->add('name_activity', TextType::class, [
                'label' => 'Nombre de la Actividad',
                'required' => true,
                'attr' => ['class' => 'form-control border-primary'],
            ])
            ->add('photos', FileType::class, [
                'label' => 'Foto (Img file)',
                'mapped' => false,  
                'required' => false, 
                'attr' => ['accept' => 'image/*']
            ])

            ->add('activityBBDD', EntityType::class, [
                'class' => ActivityBBDD::class,
                'choice_label' => 'name',
                'mapped' => true,
                'required' => true,
                'label' => false, 
                'attr' => ['style' => 'display:none;'] 
            ]);

            $formModifier = function(FormInterface $form, Category $category = null){
                $subcategories = null === $category ? [] : $category->getSubcategory();

                $form->add('subcategory', EntityType::class, [
                    'class' => Subcategory::class,
                    'placeholder' => 'Selecciona una Subcategoria',
                    'choices' => $subcategories,
                    'required' => true,
                ]);
            };
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FinishedActivity::class,
        ]);
    }
}


