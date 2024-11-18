<?php

namespace App\Controller;

use App\Entity\Subcategory;
use App\Form\SubcategoryType;
use App\Repository\SubcategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/subcategory')]
final class SubcategoryController extends AbstractController
{
    #[Route(name: 'app_subcategory_index', methods: ['GET'])]
    public function index(SubcategoryRepository $subcategoryRepository, EntityManagerInterface $entityManager): Response
    {
        // Inicializa las subcategorías predefinidas
        //$this->initializePredefinedSubcategories($entityManager);

        return $this->render('subcategory/index.html.twig', [
            'subcategories' => $subcategoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_subcategory_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
    
        // Crear el formulario para nuevas subcategorías
        $subcategory = new Subcategory();
        $form = $this->createForm(SubcategoryType::class, $subcategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($subcategory);
            $entityManager->flush();

            return $this->redirectToRoute('app_subcategory_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('subcategory/new.html.twig', [
            'subcategory' => $subcategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_subcategory_show', methods: ['GET'])]
    public function show(Subcategory $subcategory): Response
    {
        return $this->render('subcategory/show.html.twig', [
            'subcategory' => $subcategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_subcategory_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Subcategory $subcategory, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SubcategoryType::class, $subcategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_subcategory_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('subcategory/edit.html.twig', [
            'subcategory' => $subcategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_subcategory_delete', methods: ['POST'])]
    public function delete(Request $request, Subcategory $subcategory, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subcategory->getId(), $request->request->get('_token'))) {
            $entityManager->remove($subcategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_subcategory_index', [], Response::HTTP_SEE_OTHER);
    }
    // Método para manejar la solicitud de subcategorías dinámicas
    #[Route('/subcategory/get_subcategory/{id}', name: 'get_subcategory', methods: ['GET'])]
    public function getSubcategoriesByCategory(Request $request, int $id, SubcategoryRepository $subcategoryRepository): JsonResponse
    {
        // Obtener el id de la categoría desde la solicitud GET
        $categoryId = $id;
        
        // Si se recibe un id de categoría
        if ($categoryId) {
            // Encuentra las subcategorías asociadas a la categoría seleccionada
            $subcategories = $subcategoryRepository->findBy(['category' => $categoryId]);

            // Prepara la respuesta en formato JSON
            $data = [];
            foreach ($subcategories as $subcategory) {
                $data[] = [
                    'id' => $subcategory->getId(),
                    'name' => $subcategory->getName(), // Utilizando 'name' de Subcategory
                ];
            }

            return new JsonResponse($data);
        }

        // Si no se proporciona un category_id, retorna un error 400
        return new JsonResponse([], 400); 
    }

}