<?php

namespace App\Controller;

use App\Entity\Donante;
use App\Form\DonanteType;
use App\Repository\DonanteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/donante/crud')]
class DonanteCrudController extends AbstractController
{
    #[Route('/', name: 'app_donante_crud_index', methods: ['GET'])]
    public function index(DonanteRepository $donanteRepository): Response
    {
        return $this->render('donante_crud/index.html.twig', [
            'donantes' => $donanteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_donante_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $donante = new Donante();
        $form = $this->createForm(DonanteType::class, $donante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($donante);
            $entityManager->flush();

            return $this->redirectToRoute('app_register', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('donante_crud/new.html.twig', [
            'donante' => $donante,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_donante_crud_show', methods: ['GET'])]
    public function show(Donante $donante): Response
    {
        return $this->render('donante_crud/show.html.twig', [
            'donante' => $donante,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_donante_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Donante $donante, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DonanteType::class, $donante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_donante_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('donante_crud/edit.html.twig', [
            'donante' => $donante,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_donante_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Donante $donante, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$donante->getId(), $request->request->get('_token'))) {
            $entityManager->remove($donante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_donante_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
