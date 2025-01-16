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

#[Route('/subcategory')]
final class SubcategoryController extends AbstractController
{
    #[Route(name: 'app_subcategory_index', methods: ['GET'])]
    public function index(SubcategoryRepository $subcategoryRepository, EntityManagerInterface $entityManager): Response
    {
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

    #[Route('/all', name: 'app_subcategory_all', methods: ['GET'])]
    public function getAllSubcategories(SubcategoryRepository $subcategoryRepository): Response
    {
        $subcategories = $subcategoryRepository->findAll();

        $data = array_map(function (Subcategory $subcategory) {
            return [
                'id' => $subcategory->getId(),
                'name' => $subcategory->getName(),
            ];
        }, $subcategories);

        return $this->json($data);
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

    #[Route('/{id}/category', name: 'get_category_by_subcategory', methods: ['GET'])]
    public function getCategoryBySubcategory($id, SubcategoryRepository $subcategoryRepository): Response
    {
        $subcategory = $subcategoryRepository->find($id);

        if (!$subcategory) {
            return $this->json(['error' => 'Subcategoría no encontrada'], 404);
        }

        $category = $subcategory->getCategory();

        if (!$category) {
            return $this->json(['error' => 'Categoría no encontrada'], 404);
        }

        return $this->json(['categoryId' => $category->getId()]);
    }

}
