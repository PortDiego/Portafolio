<?php

namespace App\Controller;

use App\Entity\FinishedActivity;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends AbstractController
{
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
}
