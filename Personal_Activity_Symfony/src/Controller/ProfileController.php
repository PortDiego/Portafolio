<?php

namespace App\Controller;

use App\Entity\FinishedActivity;
use App\Entity\User;
use App\Entity\Profile;
use App\Form\ProfileType;
use App\Form\PasswordChangeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\FormError;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProfileController extends AbstractController
{
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/profile', name: 'app_profile')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        $finishedActivities = $entityManager->getRepository(FinishedActivity::class)->findBy(['user' => $user]);

        $userName = $user->getName();

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'finishedActivities' => $finishedActivities,
            'userName' => $userName,
        ]);
    }

    private $passwordHasher;

    #[Route('/profile/settings', name: 'app_settings')]
    public function settings(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $profile = $user->getProfile();

        $form = $this->createForm(ProfileType::class, $profile);
        $form->handleRequest($request);

        $passwordForm = $this->createForm(PasswordChangeType::class, $user);
        $passwordForm->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->updateUserFields($request, $user);

            // Gestión de la foto subida
            $file = $form->get('photo')->getData();
            if ($file instanceof UploadedFile) {
                $binaryData = file_get_contents($file->getPathname());
                if (is_resource($binaryData)) {
                    $binaryData = stream_get_contents($binaryData);
                }
                $profile->setPhoto($binaryData);
            }

            $entityManager->persist($profile);
            $entityManager->flush();

            $this->addFlash('success', 'Perfil actualizado correctamente.');
            return $this->redirectToRoute('app_settings');
        }

        if ($passwordForm->isSubmitted()) {
            // Obtén los datos del formulario
            $currentPassword = $passwordForm->get('currentPassword')->getData();
            $newPassword = $passwordForm->get('newPassword')->getData();
            $confirmPassword = $passwordForm->get('confirmPassword')->getData();

            // Obtén la contraseña almacenada
            $storedPassword = $user->getPassword();

            // Verificar si el formulario es válido
            if ($passwordForm->isValid()) {
                // Verifica si la contraseña actual es válida
                if (!$this->passwordHasher->isPasswordValid($user, $currentPassword)) {
                    $this->addFlash('error', 'La contraseña actual no es válida.');
                } else {
                    // Verificar que la nueva contraseña y la confirmación coincidan
                    if ($newPassword !== $confirmPassword) {
                        $this->addFlash('error', 'Las contraseñas nuevas no coinciden.');
                    } else {
                        $newPasswordHash = $this->passwordHasher->hashPassword($user, $newPassword);
                        $user->setPassword($newPasswordHash);
                        $entityManager->flush();
                        $this->addFlash('success', 'Contraseña actualizada con éxito.');
                    }
                }

                return $this->redirectToRoute('app_settings');
            }
        }

        return $this->render('profile/settings.html.twig', [
            'form' => $form->createView(),
            'passwordForm' => $passwordForm->createView(),
            'profile' => $profile,
        ]);
    }


    private function updateUserFields(Request $request, $user): void
    {
        $newName = $request->request->get('name');
        $newFirstSurname = $request->request->get('firstSurname');
        $newEmail = $request->request->get('email');

        if ($newName) {
            $user->setName($newName);
        }

        if ($newFirstSurname) {
            $user->setFirstSurname($newFirstSurname);
        }

        if ($newEmail) {
            $user->setEmail($newEmail);
        }
    }

    #[Route('/profile/photo/{id}', name: 'profile_show_photo')]
    public function showProfilePhoto(Profile $profile): Response
    {
        $photo = $profile->getPhoto();

        if (!$photo) {
            throw $this->createNotFoundException('No se encontró la foto.');
        }

        // Verifica si los datos binarios son una cadena (string)
        if (is_resource($photo)) {
            $photo = stream_get_contents($photo);
        }

        if (!is_string($photo)) {
            throw $this->createNotFoundException('El contenido de la foto no es válido.');
        }

        // Obtener el tipo MIME de la imagen
        $imageInfo = getimagesizefromstring($photo);
        if (!$imageInfo) {
            throw $this->createNotFoundException('No se pudo determinar el formato de la imagen.');
        }

        $mimeType = $imageInfo['mime'];

        $maxWidth = 800;
        $maxHeight = 800;

        $image = imagecreatefromstring($photo);
        $width = imagesx($image);
        $height = imagesy($image);

        if ($width > $maxWidth || $height > $maxHeight) {
            $ratio = min($maxWidth / $width, $maxHeight / $height);
            $newWidth = (int)($width * $ratio);
            $newHeight = (int)($height * $ratio);

            $resizedImage = imagescale($image, $newWidth, $newHeight);

            ob_start();
            imagejpeg($resizedImage);
            $photo = ob_get_contents();
            ob_end_clean();
        }

        return new Response($photo, 200, [
            'Content-Type' => $mimeType,
        ]);
    }
}
