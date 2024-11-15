<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ActivityBBDDController extends AbstractController
{
    #[Route('/activity/b/b/d/d', name: 'app_activity_b_b_d_d')]
    public function index(): Response
    {
        return $this->render('activity_bbdd/index.html.twig', [
            'controller_name' => 'ActivityBBDDController',
        ]);
    }
}
