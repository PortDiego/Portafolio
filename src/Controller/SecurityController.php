<?php

namespace App\Controller;

use App\Service\PasswordResetService;
use App\Form\ForgotPasswordType;
use App\Form\ResetPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route('/password', name: 'app_password')]
    public function request(Request $request, PasswordResetService $resetService): Response
    {
        $form = $this->createForm(ForgotPasswordType::class);
        $form->handleRequest($request);

        /* dd($form->getData(), $form->isSubmitted(), $form->isValid()); */

        if ($form->isSubmitted() && $form->isValid()) {
            // Lógica para enviar el correo de restablecimiento de contraseña
            $resetService->sendPasswordResetEmail($form->get('email')->getData());
            $this->addFlash('success', 'Te hemos enviado un enlace para restablecer tu contraseña.');

            return $this->redirectToRoute('app_home');
        }
        
        return $this->render('security/password.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/password/{token}', name: 'app_reset_password')]
    public function reset(string $token, Request $request, PasswordResetService $resetService): Response
    {
        // Verificar si el token es válido antes de intentar obtener el usuario
        $user = $resetService->validateToken($token);

        if (!$user) {
            // Si no se encuentra un usuario, el token es inválido o ha expirado
            $this->addFlash('error', 'El enlace de restablecimiento de contraseña es inválido o ha expirado.');
            return $this->redirectToRoute('app_login');
        }

        // Crear formulario para restablecer la contraseña
        $form = $this->createForm(ResetPasswordType::class);
        $form->handleRequest($request);

    

        if ($form->isSubmitted() && $form->isValid()) {
            // Actualizar la contraseña y eliminar el token
            $resetService->resetPassword($token, $form->get('password')->getData());
            $this->addFlash('success', 'Tu contraseña ha sido restablecida con éxito.');
            return $this->redirectToRoute('app_login'); 
        }

        // Renderizar el formulario
        return $this->render('security/reset_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}