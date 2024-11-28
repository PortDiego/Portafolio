<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Catalog;
use App\Form\CatalogType;
use App\Repository\CatalogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CatalogController extends AbstractController
{
    #[Route('/activity_bbdd', name: 'app_activity_bbdd_index')]
    public function index(CatalogRepository $repository): Response
    {
        $activitiesBBDD = $repository->findAll();

        return $this->render('activity_bbdd/index.html.twig', [
            'activitiesBBDD' => $activitiesBBDD,
        ]);
    }

    #[Route('/activity_bbdd/new', name: 'app_activity_bbdd_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $catalog = new Catalog();
        $form = $this->createForm(CatalogType::class, $catalog);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($catalog);
            $entityManager->flush();

            return $this->redirectToRoute('app_activity_bbdd_index');
        }

        return $this->render('activity_bbdd/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/activity_bbdd/{id}/edit', name: 'app_activity_bbdd_edit')]
    public function edit(Request $request, Catalog $finishedActivity, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CatalogType::class, $finishedActivity);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->flush();

            return $this->redirectToRoute('app_activity_bbdd_index');
        }

        return $this->render('activity_bbdd/edit.html.twig', [
            'form' => $form->createView(),
            'activity' => $finishedActivity,
        ]);
    }

    #[Route('/activity_bbdd/{id}/delete', name: 'app_activity_bbdd_delete')]
    public function delete(Request $request, Catalog $finishedActivity, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$finishedActivity->getId(), $request->request->get('_token'))){
            $entityManager->remove($finishedActivity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_activity_bbdd_index');
    }
}
