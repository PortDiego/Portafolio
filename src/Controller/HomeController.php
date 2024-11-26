<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Entity\Category;
use App\Form\ActivityType;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;



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
    #[Route('/get-subcategorias/{id}', name: 'get_subcategorias')]
    public function getSubcategorias(int $id, EntityManagerInterface $entityManager): Response
    {
        // Buscar la categoría por su ID
        $category = $entityManager->getRepository(Category::class)->find($id);

        if (!$category) {
            return $this->json(['error' => 'Categoría no encontrada'], 404);
        }

        // Obtener las subcategorías de la categoría encontrada
        $subcategorias = $category->getSubcategory();

        $data = [];
        foreach ($subcategorias as $subcategoria) {
            $data[] = [
                'id' => $subcategoria->getId(),
                'name' => $subcategoria->getName(),
            ];
        }

        return $this->json($data);
    }
    
}
