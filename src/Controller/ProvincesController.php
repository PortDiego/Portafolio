<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProvincesController extends AbstractController
{
    #[Route('/provinces', name: 'app_provinces')]
    public function index(): Response
    {
        return $this->render('provinces/index.html.twig', [
            'controller_name' => 'ProvincesController',
        ]);
    }
}