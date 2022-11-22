<?php

namespace App\Controller\Module_epargne;

use App\Entity\TransfertProduit;
use App\Form\TransfertProduit1Type;
use App\Repository\TransfertProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/transfert/produit')]
class TransfertProduitController extends AbstractController
{
    #[Route('/', name: 'app_transfert_produit_index', methods: ['GET'])]
    public function index(TransfertProduitRepository $transfertProduitRepository): Response
    {
        return $this->render('Module_epargne/transfert_produit/index.html.twig', [
            'transfert_produits' => $transfertProduitRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_transfert_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TransfertProduitRepository $transfertProduitRepository): Response
    {
        $transfertProduit = new TransfertProduit();
        $form = $this->createForm(TransfertProduit1Type::class, $transfertProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transfertProduitRepository->add($transfertProduit, true);

            return $this->redirectToRoute('app_transfert_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_epargne/transfert_produit/new.html.twig', [
            'transfert_produit' => $transfertProduit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_transfert_produit_show', methods: ['GET'])]
    public function show(TransfertProduit $transfertProduit): Response
    {
        return $this->render('Module_epargne/transfert_produit/show.html.twig', [
            'transfert_produit' => $transfertProduit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_transfert_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TransfertProduit $transfertProduit, TransfertProduitRepository $transfertProduitRepository): Response
    {
        $form = $this->createForm(TransfertProduit1Type::class, $transfertProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transfertProduitRepository->add($transfertProduit, true);

            return $this->redirectToRoute('app_transfert_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_epargne/transfert_produit/edit.html.twig', [
            'transfert_produit' => $transfertProduit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_transfert_produit_delete', methods: ['POST'])]
    public function delete(Request $request, TransfertProduit $transfertProduit, TransfertProduitRepository $transfertProduitRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transfertProduit->getId(), $request->request->get('_token'))) {
            $transfertProduitRepository->remove($transfertProduit, true);
        }

        return $this->redirectToRoute('app_transfert_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}
