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
    public function index(Request $request,ListeRougeRepository $listeRougeRepository,AgenceRepository $agenceRepository): Response
    {
        $listerouge=$listeRougeRepository->ListeRouge();

        $form=$this->createForm(FiltreListeRougeIndividuelType::class);
        $filtredate=$form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $listeRouge=$listeRougeRepository->ListeRougeIndividuel(
                $filtredate->get('Du')->getData(),
                $filtredate->get('Au')->getData()
            );
        }
        return $this->renderForm('Module_client/liste_rouge/index.html.twig', [
            'listerouge' => $listerouge,
            'agences'=>$agenceRepository->findAll(),
            'form'=>$form
        ]);
    }

    // groupe
    #[Route('/groupe', name: 'app_liste_rougegroupe_index')]
    public function groupe(Request $request,ListeRougeRepository $listeRougeRepository,AgenceRepository $agenceRepository): Response
    {
        $listerouge=$listeRougeRepository->ListeRougeGroupe();

        $form=$this->createForm(FiltreListeRougeGroupeType::class);
        $filtregroupe= $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $listeRouge=$listeRougeRepository->ListeRougeClientGroupe(
                $filtregroupe->get('Du')->getData(),
                $filtregroupe->get('Au')->getData()
            );
        }

        return $this->renderForm('Module_client/liste_rouge/listegroupe.html.twig', [
            'listerouge' => $listerouge,
            'agences'=>$agenceRepository->findAll(),
            'form'=>$form
        ]);
    }

    #[Route('/new', name: 'app_liste_rouge_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ListeRougeRepository $listeRougeRepository): Response
    {
        $listeRouge = new ListeRouge();
        $form = $this->createForm(ListeRougeType::class, $listeRouge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $listeRougeRepository->add($listeRouge, true);

            return $this->redirectToRoute('app_liste_rouge_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_client/liste_rouge/new.html.twig', [
            'liste_rouge' => $listeRouge,
            'form' => $form,
        ]);
    }
    // groupe

    #[Route('/new/groupe', name: 'app_liste_rougegroupe_new', methods: ['GET', 'POST'])]
    public function Listerougegroupe(Request $request, ListeRougeRepository $listeRougeRepository): Response
    {
        $listeRouge = new ListeRouge();
        $form = $this->createForm(ListeRougeGroupeType::class, $listeRouge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $listeRougeRepository->add($listeRouge, true);

            return $this->redirectToRoute('app_liste_rouge_index', [], Response::HTTP_SEE_OTHER);
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
