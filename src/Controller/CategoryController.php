<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Subcategory;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Psr\Log\LoggerInterface;

#[Route('/category')]
final class CategoryController extends AbstractController{

    #[Route(name: 'app_category_index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->createCategories($entityManager);

        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('category/new.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_category_show', methods: ['GET'])]
    public function show(Category $category): Response
    {
        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_category_delete', methods: ['POST'])]
    public function delete(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/get_subcategory', name: 'get_subcategory', methods: ['GET'])]
    public function getSubcategory(Request $request, LoggerInterface $logger): JsonResponse
    {
        // Obtener el id de categoría
        $categoryId = $request->query->get('category_id');
        $logger->info('Requesting subcategories for category ID: ' . $categoryId);

        if ($categoryId) {
            $category = $this->getDoctrine()->getRepository(Category::class)->find($categoryId);
            $logger->info('Category Search Result', ['category' => $category]);

            if ($category) {
                $subcategories = $category->getSubcategory(); 
                $logger->info('Subcategories found', ['subcategories' => $subcategories]);

                $data = [];
                foreach ($subcategories as $subcategory) {
                    $data[] = [
                        'id' => $subcategory->getId(),
                        'name' => $subcategory->getName(),
                    ];
                }

                $logger->info('Returning subcategory data', ['data' => $data]);
                return new JsonResponse($data);
            } else {
                $logger->warning('A category was not found with the given ID');
            }
        } else {
            $logger->warning('No valid category ID provided');
        }

        return new JsonResponse([], 400);
    }
}
