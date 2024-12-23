<?php

namespace App\Controller;

use App\Entity\Catalog; 
use App\Entity\FinishedActivity;
use App\Entity\Photo;
use App\Form\FinishedActivityType;
use App\Repository\FinishedActivityRepository;
use App\Repository\CatalogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Category;
use App\Entity\Subcategory; 
use Symfony\Component\HttpFoundation\JsonResponse; 

#[Route('/finishedActivity')]
final class FinishedActivityController extends AbstractController{
    #[Route(name: 'app_activity_index', methods: ['GET'])]
    public function index(FinishedActivityRepository $finishedActivityRepository): Response
    {
        return $this->render('finishedActivity/index.html.twig', [
            'finishedActivities' => $finishedActivityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_activity_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $finishedActivity = new FinishedActivity();
        $form = $this->createForm(FinishedActivityType::class, $finishedActivity);
        $form->handleRequest($request);

        $catalog = null;

        $catalogId = $request->get('catalog');

        if ($catalogId) {
            $catalog = $entityManager->getRepository(Catalog::class)->find($catalogId);
            if ($catalog) {
                $form->get('catalog')->setData($catalog);
            } else {
                $this->addFlash('error', 'No se encontró la actividad BBDD.');
            }
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $finishedActivity->setUser($user);

            $file = $form->get('photos')->getData();

            if($file)
            {
                // Generar un nombre único para la imagen
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();

                // Mover el archivo a la carpeta de destino
                $file->move(
                    $this->getParameter('activity_images_path'), 
                    $fileName
                );

                // Crear una nueva instancia de Photo y asignar el nombre de la foto
                $photo = new Photo();
                $photo->setNamePhoto($fileName);
                $photo->setFinishedActivity($finishedActivity);

                // Persistir la foto en la base de datos
                $entityManager->persist($photo);
                $finishedActivity->setPhotoPath($fileName);
            }

            $entityManager->persist($finishedActivity);
            $entityManager->flush();

            return $this->redirectToRoute('app_activity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('home/add_activity.html.twig', [
            'finishedActivities' => $finishedActivity,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_activity_show', methods: ['GET'])]
    public function show(FinishedActivity $finishedActivity): Response
    {
        return $this->render('finishedActivity/show.html.twig', [
            'finishedActivities' => $finishedActivity,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_activity_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FinishedActivity $finishedActivity, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FinishedActivityType::class, $finishedActivity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_activity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('finishedActivity/edit.html.twig', [
            'finishedActivities' => $finishedActivity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_activity_delete', methods: ['POST'])]
    public function delete(Request $request, FinishedActivity $finishedActivity, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$finishedActivity->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($finishedActivity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_activity_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/subcategories/{categoryId}', name: 'get_subcategories', methods: ['GET'])]
    public function getSubcategories($categoryId, EntityManagerInterface $entityManager): JsonResponse
    {
        $subcategoryRepository = $entityManager->getRepository(Subcategory::class);
        $subcategories = $subcategoryRepository->findBy(['category' => $categoryId]);

        $data = [];
        foreach($subcategories as $subcategory){
            $data[] = [
                'id' => $subcategory->getId(),
                'name' => $subcategory->getName(),
            ];
        }
        
        return $this->json($data);
    }

    #[Route('/activity_bbdd/{subcategoryId}', name: 'get_activity_bbdd', methods: ['GET'])]
    public function getCatalog($subcategoryId, EntityManagerInterface $entityManager): JsonResponse
    {
        $catalogRepository = $entityManager->getRepository(Catalog::class);
        $catalog = $catalogRepository->findOneBy(['subcategory' => $subcategoryId]);

        if ($catalog) {
            return $this->json([
                'id' => $catalog->getId(),
                'name' => $catalog->getName(),
            ]);
        }
    }
}
