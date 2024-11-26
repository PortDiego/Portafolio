<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\ActivityBBDDRepository;


class ActivityBBDDController extends AbstractController
{
    #[Route('/activity/b/b/d/d', name: 'app_activity_b_b_d_d')]
    public function index(): Response
    {
        return $this->render('activity_bbdd/index.html.twig', [
            'controller_name' => 'ActivityBBDDController',
        ]);
    }
    // Método para obtener las actividades asociadas a una subcategoría
    #[Route('/activitybbdd/get_activitybbdd/{subcategoryId}', name: 'get_activitybbdd', methods: ['GET'])]
    public function getActivitiesBySubcategory(int $subcategoryId, ActivityBBDDRepository $activityBBDDRepository): JsonResponse
    {
        // Encuentra las actividades asociadas a la subcategoría proporcionada
        $activities = $activityBBDDRepository->findBy(['subcategory' => $subcategoryId]);

        // Prepara los datos de las actividades para enviarlos como respuesta
        $data = [];
        foreach ($activities as $activity) {
            $data[] = [
                'id' => $activity->getId(),
                'name' => $activity->getName(),  // Usamos 'name' para mostrar el nombre de la actividad
            ];
        }

        // Retorna la respuesta en formato JSON
        return new JsonResponse($data);
    }

}