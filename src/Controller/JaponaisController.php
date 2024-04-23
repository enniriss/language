<?php

namespace App\Controller;

use App\Entity\Japonais;
use App\Form\JaponaisType;
use App\Repository\JaponaisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/japonais')]
class JaponaisController extends AbstractController
{
    #[Route('/', name: 'app_japonais_index', methods: ['GET'])]
    public function index(JaponaisRepository $japonaisRepository): Response
    {
        return $this->render('japonais/index.html.twig', [
            'japonais' => $japonaisRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_japonais_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $japonai = new Japonais();
        $form = $this->createForm(JaponaisType::class, $japonai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($japonai);
            $entityManager->flush();

            return $this->redirectToRoute('app_japonais_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('japonais/new.html.twig', [
            'japonai' => $japonai,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_japonais_show', methods: ['GET'])]
    public function show(Japonais $japonai): Response
    {
        return $this->render('japonais/show.html.twig', [
            'japonai' => $japonai,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_japonais_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Japonais $japonai, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(JaponaisType::class, $japonai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_japonais_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('japonais/edit.html.twig', [
            'japonai' => $japonai,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_japonais_delete', methods: ['POST'])]
    public function delete(Request $request, Japonais $japonai, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$japonai->getId(), $request->request->get('_token'))) {
            $entityManager->remove($japonai);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_japonais_index', [], Response::HTTP_SEE_OTHER);
    }
}
