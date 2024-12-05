<?php
namespace App\Service;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Entity\PasswordResetToken;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PasswordResetService
{
    private $mailer;
    private $entityManager;
    private $router;
    private $passwordEncoder;

    public function __construct(MailerInterface $mailer, EntityManagerInterface $entityManager, UrlGeneratorInterface $router, UserPasswordHasherInterface $passwordEncoder)
    {
        $this->mailer = $mailer;
        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->passwordEncoder = $passwordEncoder;
    }

    //Enviar el correo al usuario
    public function sendPasswordResetEmail(string $email)
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

        if (!$user) {
            throw new \Exception('No se encontró un usuario con ese correo electrónico.');
        }

        // Generar token de restablecimiento de contraseña
        $token = $this->generateResetToken($user);
        // Guarda el token en la base de datos (con fecha de expiración si es necesario)

        // Crear el enlace de restablecimiento de contraseña
        $resetUrl = $this->router->generate('app_reset_password', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);

        // Enviar correo electrónico
        $emailMessage = (new Email())
            ->from('no-reply@miempresa.com')
            ->to($user->getEmail())
            ->subject('Recuperación de contraseña')
            ->html('<p>Haz clic en el siguiente enlace para restablecer tu contraseña: <a href="' . $resetUrl . '">' . $resetUrl . '</a></p>');

        $this->mailer->send($emailMessage);
    }

    //Generar el token del usuario
    public function generateResetToken(User $user): string
    {
        // Generar un token único
        $token = bin2hex(random_bytes(32));

        // Crear y guardar el token
        $passwordResetToken = new PasswordResetToken($user, $token);
        $this->entityManager->persist($passwordResetToken);
        $this->entityManager->flush();

        return $token;
    }

    // Método para validar el token
    public function validateToken(string $token): ?User
    {
        // Buscar el token en la base de datos
        $passwordResetToken = $this->entityManager->getRepository(PasswordResetToken::class)->findOneBy(['token' => $token]);


        if (!$passwordResetToken) {
            return false; // El token no existe
        }

        // Verificar si el token ha expirado
        if ($passwordResetToken->isExpired()) {
            return false;
        }

        return $passwordResetToken->getUser(); 
    }

    //Restablecer la contraseña del usuario
    public function resetPassword(string $token, string $newPassword)
    {
        $passwordResetToken = $this->entityManager->getRepository(PasswordResetToken::class)->findOneBy(['token' => $token]);

        if (!$passwordResetToken || $passwordResetToken->isExpired()) {
            throw new \Exception('El token es inválido o ha expirado.');
        }

        // Obtener el usuario y actualizar la contraseña
        $user = $passwordResetToken->getUser();
        $hashedPassword = $this->passwordEncoder->hashPassword($user, $newPassword);
        $user->setPassword($hashedPassword);

        // Eliminar el token usado
        $this->entityManager->remove($passwordResetToken);
        $this->entityManager->flush();
    }
}
