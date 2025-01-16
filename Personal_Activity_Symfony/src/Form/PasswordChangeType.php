<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotCompromisedPassword;

class PasswordChangeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('currentPassword', PasswordType::class, [
                'label' => 'Contraseña actual',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, ingresa tu contraseña actual.',
                    ]),
                ],
            ])
            ->add('newPassword', PasswordType::class, [
                'label' => 'Nueva contraseña',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, ingresa una nueva contraseña.',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Tu contraseña debe tener al menos {{ limit }} caracteres.',
                    ]),
                ],
            ])
            ->add('confirmPassword', PasswordType::class, [
                'label' => 'Confirmar contraseña',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, confirma tu nueva contraseña.',
                    ]),
                ],
            ]);
    }
}
