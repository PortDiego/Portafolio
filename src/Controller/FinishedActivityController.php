<?php

namespace App\Controller;

use App\Entity\FinishedActivity;
use App\Form\ActivityType;
use App\Repository\FinishedActivityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Category; 
use Symfony\Component\HttpFoundation\JsonResponse; 

#[Route('/finishedActivity')]
final class FinishedActivityController extends AbstractController{
    #[Route(name: 'app_activity_index', methods: ['GET'])]
    public function index(FinishedActivityRepository $finishedActivityRepository): Response
    {
        return $this->render('finishedActivity/index.html.twig', [
            'activities' => $finishedActivityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_activity_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $activity = new FinishedActivity();
        $form = $this->createForm(FinishedActivityType::class, $finishedActivity);
        $form->handleRequest($request);
        dump($activity);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $activity->setUser($user);
            $entityManager->persist($activity);
            $entityManager->flush();

            return $this->redirectToRoute('app_activity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('finishedActivity/new.html.twig', [
            'activity' => $activity,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_activity_show', methods: ['GET'])]
    public function show(Activity $activity): Response
    {
        return $this->render('finishedActivity/show.html.twig', [
            'activity' => $activity,
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
            'activity' => $activity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_activity_delete', methods: ['POST'])]
    public function delete(Request $request, FinishedActivity $finishedActivity, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activity->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($activity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_activity_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/add-finished-activity', name: 'add_finished_activity')]
    public function addActivity(Request $request): Response
    {
        $finishedActivity = new FinishedActivity();
        
        $form = $this->createForm(FinishedActivityType::class, $finishedActivity);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $category = $form->get('category')->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($finishedActivity);
            $entityManager->flush();

            return $this->redirectToRoute('some_success_route'); 
        }

        return $this->render('finished_activity/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
