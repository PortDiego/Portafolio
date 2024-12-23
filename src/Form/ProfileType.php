<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Profile;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('username', TextType::class, [
            'label' => 'Nombre de Usuario',
            'attr' => ['class' => 'form-control']
        ])

        ->add('biography', TextareaType::class, [
            'label' => 'Biografía',
            'required' => false,
            'attr' => ['class' => 'form-control', 'rows' => 4], 
        ])

        ->add('country', TextType::class, [
            'label' => 'País',
            'required' => false,
            'attr' => ['class' => 'form-control'],
        ])

        ->add('city', TextType::class, [
            'label' => 'Ciudad',
            'required' => false,
            'attr' => ['class' => 'form-control'], 
        ])

        ->add('postalCode', TextType::class, [
            'label' => 'Código Postal',
            'required' => false,
            'attr' => ['class' => 'form-control'],
        ])

        ->add('address', TextType::class, [
            'label' => 'Dirección',
            'required' => false,
            'attr' => ['class' => 'form-control'], 
        ])

        ->add('photo', FileType::class, [
            'label' => false,
            'required' => false,
            'mapped' => false,
            'attr' => ['accept' => 'image/*'],
            'constraints' => [
            new File([
                'maxSize' => '5M', // Tamaño máximo de 5MB
                'mimeTypes' => ['image/jpeg', 'image/png'], // Solo JPG y PNG
                'mimeTypesMessage' => 'Por favor, sube una imagen en formato JPG o PNG.',
                'maxSizeMessage' => 'La imagen es demasiado grande. El tamaño máximo permitido es de 5MB.',
                ])
            ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profile::class,
        ]);
    }
}
