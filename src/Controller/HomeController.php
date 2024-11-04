<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Form\ActivityType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    } 
    #[Route('/home/add-activity', name: 'add_activity')]
    public function addActivity(Request $request, EntityManagerInterface $entityManager): Response
    {
        $activity = new Activity();
        $form = $this->createForm(ActivityType::class, $activity);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activity->setUser($this->getUser());  // Asigna la actividad al usuario actual
            $entityManager->persist($activity);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/add_activity.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

