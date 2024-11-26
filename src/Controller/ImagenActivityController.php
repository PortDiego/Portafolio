<?php

namespace App\Controller;

use App\Entity\ImagenActivity;
use App\Form\ImagenActivityType;
use App\Repository\ImagenActivityRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/imagen/activity')]
final class ImagenActivityController extends AbstractController{
    #[Route(name: 'app_imagen_activity_index', methods: ['GET'])]
    public function index(ImagenActivityRepository $imagenActivityRepository): Response
    {
        return $this->render('imagen_activity/index.html.twig', [
            'imagen_activities' => $imagenActivityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_imagen_activity_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $imagenActivity = new ImagenActivity();
        $form = $this->createForm(ImagenActivityType::class, $imagenActivity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('url')->getData();
            if($file){
                $filename = $fileUploader->upload($file);
                $imagenActivity->setUrl($filename);
            }
            $entityManager->persist($imagenActivity);
            $entityManager->flush();

            return $this->redirectToRoute('app_imagen_activity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('imagen_activity/new.html.twig', [
            'imagen_activity' => $imagenActivity,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_imagen_activity_show', methods: ['GET'])]
    public function show(ImagenActivity $imagenActivity): Response
    {
        return $this->render('imagen_activity/show.html.twig', [
            'imagen_activity' => $imagenActivity,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_imagen_activity_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ImagenActivity $imagenActivity, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ImagenActivityType::class, $imagenActivity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_imagen_activity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('imagen_activity/edit.html.twig', [
            'imagen_activity' => $imagenActivity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_imagen_activity_delete', methods: ['POST'])]
    public function delete(Request $request, ImagenActivity $imagenActivity, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$imagenActivity->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($imagenActivity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_imagen_activity_index', [], Response::HTTP_SEE_OTHER);
    }
}
