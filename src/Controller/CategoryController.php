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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

#[Route('/category')]
final class CategoryController extends AbstractController
{
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
        if ($this->isCsrfTokenValid('delete' . $category->getId(), $request->request->get('_token'))) {
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/get_subcategory', name: 'get_subcategory', methods: ['GET'])]
    public function getSubcategory(Request $request, LoggerInterface $logger, EntityManagerInterface $entityManager): JsonResponse
    {
        $categoryId = $request->query->get('category_id');
        $logger->info('Requesting subcategories for category ID: ' . $categoryId);

        if ($categoryId) {
            $category = $entityManager->getRepository(Category::class)->find($categoryId);
            $logger->info('Category Search Result', ['category' => $category]);

            if ($category) {
                $subcategories = $category->getSubcategory();
                $logger->info('Subcategories found', ['subcategories' => $subcategories]);

                $data = [];
                foreach ($subcategories as $subcategory) {
                    $data[] = [
                        'id' => $subcategory->getId(),
                        'name' => $subcategory->getNameSub(),
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

    private function createCategories(EntityManagerInterface $entityManager): void
    {
        // Ejemplo de categorías por defecto
        $categories = ['Montana', 'Agua', 'Nieve'];

        foreach ($categories as $categoryName) {
            // Verificar si la categoría ya existe
            $existingCategory = $entityManager->getRepository(Category::class)
                ->findOneBy(['name' => $categoryName]);

            if (!$existingCategory) {
                $category = new Category();
                $category->setNameCat($categoryName);
                $entityManager->persist($category);
            }
        }

        $entityManager->flush();
    }
}
