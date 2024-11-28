<?php

namespace App\Controller;

use App\Entity\FinishedActivity;
use App\Form\FinishedActivityType;
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
       /*  return $this->redirectToRoute('app_activity_new'); */
    }
}

