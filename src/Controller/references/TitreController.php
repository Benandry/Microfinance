<?php

namespace App\Controller\references;

use App\Entity\Titre;
use App\Form\TitreType;
use App\Repository\TitreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/titre')]
class TitreController extends AbstractController
{
    #[Route('/', name: 'app_titre_index', methods: ['GET'])]
    public function index(TitreRepository $titreRepository): Response
    {
        return $this->render('references/titre/index.html.twig', [
            'titres' => $titreRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_titre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TitreRepository $titreRepository): Response
    {
        $titre = new Titre();
        $form = $this->createForm(TitreType::class, $titre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $titreRepository->add($titre, true);
            $this->addFlash('success', "Ajout nouveau titre ".$titre->getTitre()."  reussite!!");
            return $this->redirectToRoute('app_titre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('references/titre/new.html.twig', [
            'titre' => $titre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_titre_show', methods: ['GET'])]
    public function show(Titre $titre): Response
    {
        return $this->render('references/titre/show.html.twig', [
            'titre' => $titre,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_titre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Titre $titre, TitreRepository $titreRepository): Response
    {
        $form = $this->createForm(TitreType::class, $titre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $titreRepository->add($titre, true);
            $this->addFlash('success', "Modification titre ".$titre->getTitre()." reussite!!");
            return $this->redirectToRoute('app_titre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('references/titre/edit.html.twig', [
            'titre' => $titre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_titre_delete', methods: ['POST'])]
    public function delete(Request $request, Titre $titre, TitreRepository $titreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$titre->getId(), $request->request->get('_token'))) {
            $titreRepository->remove($titre, true);
        }
        $this->addFlash('success', "Suppression titre ".$titre->getTitre()." reussite!!");
        return $this->redirectToRoute('app_titre_index', [], Response::HTTP_SEE_OTHER);
    }
}
