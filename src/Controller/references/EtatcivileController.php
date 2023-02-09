<?php

namespace App\Controller\references;

use App\Entity\Etatcivile;
use App\Form\EtatcivileType;
use App\Repository\EtatcivileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/etatcivile')]
class EtatcivileController extends AbstractController
{
    #[Route('/', name: 'app_etatcivile_index', methods: ['GET'])]
    public function index(EtatcivileRepository $etatcivileRepository): Response
    {
        return $this->render('references/etatcivile/index.html.twig', [
            'etatciviles' => $etatcivileRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_etatcivile_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EtatcivileRepository $etatcivileRepository): Response
    {
        $etatcivile = new Etatcivile();
        $form = $this->createForm(EtatcivileType::class, $etatcivile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etatcivileRepository->add($etatcivile, true);

            $this->addFlash('success', "Ajout d'etat civil ".$etatcivile->getEtatcivile()."  reussite!!");
            return $this->redirectToRoute('app_etatcivile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('references/etatcivile/new.html.twig', [
            'etatcivile' => $etatcivile,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etatcivile_show', methods: ['GET'])]
    public function show(Etatcivile $etatcivile): Response
    {
        return $this->render('references/etatcivile/show.html.twig', [
            'etatcivile' => $etatcivile,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_etatcivile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Etatcivile $etatcivile, EtatcivileRepository $etatcivileRepository): Response
    {
        $form = $this->createForm(EtatcivileType::class, $etatcivile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etatcivileRepository->add($etatcivile, true);

            $this->addFlash('success', "Modification d'etat civil ".$etatcivile->getEtatcivile()."  reussite!!");
            return $this->redirectToRoute('app_etatcivile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('references/etatcivile/edit.html.twig', [
            'etatcivile' => $etatcivile,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etatcivile_delete', methods: ['POST'])]
    public function delete(Request $request, Etatcivile $etatcivile, EtatcivileRepository $etatcivileRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etatcivile->getId(), $request->request->get('_token'))) {
            $etatcivileRepository->remove($etatcivile, true);
        }
        $this->addFlash('success', "Suppression d'etat civil  ".$etatcivile->getEtatcivile()."  reussite!!");
        return $this->redirectToRoute('app_etatcivile_index', [], Response::HTTP_SEE_OTHER);
    }
}
