<?php

namespace App\Controller\Module_client;

use App\Entity\ListeRouge;
use App\Form\FiltreListeRougeGroupeType;
use App\Form\FiltreListeRougeIndividuelType;
use App\Form\ListeRougeGroupeType;
use App\Form\ListeRougeType;
use App\Repository\AgenceRepository;
use App\Repository\ListeRougeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/liste/rouge')]
class ListeRougeController extends AbstractController
{
    #[Route('/', name: 'app_liste_rouge_index')]
    public function index(ListeRougeRepository $listeRougeRepository,AgenceRepository $agenceRepository): Response
    {
        $listerouge=$listeRougeRepository->ListeRouge();

        return $this->render('Module_client/liste_rouge/liste_individuel.html.twig', [
            'listerouge' => $listerouge,
        ]);
    }

    // groupe
    #[Route('/groupe', name: 'app_liste_rouge_groupe_index')]
    public function groupe(Request $request,ListeRougeRepository $listeRougeRepository,AgenceRepository $agenceRepository): Response
    {
        $listerouge=$listeRougeRepository->ListeRougeGroupe();

        return $this->renderForm('Module_client/liste_rouge/listegroupe.html.twig', [
            'listerouge' => $listerouge,
        ]);
    }

    #[Route('/individuel/new', name: 'app_liste_rouge_individuel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ListeRougeRepository $listeRougeRepository): Response
    {
        $listeRouge = new ListeRouge();
        $form = $this->createForm(ListeRougeType::class, $listeRouge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $listeRouge->setTypeClient('INDIVIDUEL');
            $listeRougeRepository->add($listeRouge, true);

            $this->addFlash('success', "Ajout du ".$listeRouge->getCodeclient()->getNomClient()." ".$listeRouge->getCodeclient()->getPrenomClient()." au liste rouge");
            return $this->redirectToRoute('app_liste_rouge_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_client/liste_rouge/form_individuel.html.twig', [
            'liste_rouge' => $listeRouge,
            'form' => $form,
        ]);
    }
    // groupe

    #[Route('groupe/new', name: 'app_liste_rouge_groupe_new', methods: ['GET', 'POST'])]
    public function Listerougegroupe(Request $request, ListeRougeRepository $listeRougeRepository): Response
    {
        $listeRouge = new ListeRouge();
        $form = $this->createForm(ListeRougeType::class, $listeRouge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $listeRouge->setTypeClient('GROUPE');
            $listeRougeRepository->add($listeRouge, true);
            $this->addFlash('success', "Ajout du ".$listeRouge->getCodegroupe()->getNomGroupe()." au liste rouge");
            return $this->redirectToRoute('app_liste_rouge_groupe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_client/liste_rouge/formgroupe.html.twig', [
            'liste_rouge' => $listeRouge,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_liste_rouge_show', methods: ['GET'])]
    public function show(ListeRouge $listeRouge): Response
    {
        return $this->render('Module_client/liste_rouge/show.html.twig', [
            'liste_rouge' => $listeRouge,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_liste_rouge_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ListeRouge $listeRouge, ListeRougeRepository $listeRougeRepository): Response
    {
        $form = $this->createForm(ListeRougeType::class, $listeRouge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $listeRougeRepository->add($listeRouge, true);

            return $this->redirectToRoute('app_liste_rouge_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_client/liste_rouge/edit.html.twig', [
            'liste_rouge' => $listeRouge,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_liste_rouge_delete', methods: ['POST'])]
    public function delete(Request $request, ListeRouge $listeRouge, ListeRougeRepository $listeRougeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$listeRouge->getId(), $request->request->get('_token'))) {
            $listeRougeRepository->remove($listeRouge, true);
        }

        return $this->redirectToRoute('app_liste_rouge_index', [], Response::HTTP_SEE_OTHER);
    }
}
