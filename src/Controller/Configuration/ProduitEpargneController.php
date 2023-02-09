<?php

namespace App\Controller\Configuration;

use App\Entity\ProduitEpargne;
use App\Form\ProduitEpargne1Type;
use App\Repository\ProduitEpargneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produit/epargne')]
class ProduitEpargneController extends AbstractController
{
    #[Route('/', name: 'app_produit_epargne_index', methods: ['GET'])]
    public function index(ProduitEpargneRepository $produitEpargneRepository): Response
    {
        $produit=$produitEpargneRepository->Produit();
        return $this->render('Configuration/produit_epargne/index.html.twig', [
            'produit_epargnes' => $produit,
        ]);
    }

    #[Route('/new', name: 'app_produit_epargne_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProduitEpargneRepository $produitEpargneRepository): Response
    {
        $produitEpargne = new ProduitEpargne();
        $form = $this->createForm(ProduitEpargne1Type::class, $produitEpargne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produitEpargneRepository->add($produitEpargne, true);

            $this->addFlash('success', "Ajout de produit epargne :  ' ".$produitEpargne->getNomproduit()." ' reussite!!");
            return $this->redirectToRoute('app_produit_epargne_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Configuration/produit_epargne/new.html.twig', [
            'produit_epargne' => $produitEpargne,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produit_epargne_show', methods: ['GET'])]
    public function show(ProduitEpargne $produitEpargne): Response
    {
        return $this->render('Configuration/produit_epargne/show.html.twig', [
            'produit_epargne' => $produitEpargne,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_produit_epargne_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProduitEpargne $produitEpargne, ProduitEpargneRepository $produitEpargneRepository): Response
    {
        $form = $this->createForm(ProduitEpargne1Type::class, $produitEpargne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produitEpargneRepository->add($produitEpargne, true);

            $this->addFlash('success', "Modification produit epargne :  ' ".$produitEpargne->getNomproduit()." ' reussite!!");
            return $this->redirectToRoute('app_produit_epargne_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Configuration/produit_epargne/edit.html.twig', [
            'produit_epargne' => $produitEpargne,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produit_epargne_delete', methods: ['POST'])]
    public function delete(Request $request, ProduitEpargne $produitEpargne, ProduitEpargneRepository $produitEpargneRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produitEpargne->getId(), $request->request->get('_token'))) {
            $produitEpargneRepository->remove($produitEpargne, true);
        }

        $this->addFlash('success', "Suppression de produit epargne :  ' ".$produitEpargne->getNomproduit()." ' reussite!!");
        return $this->redirectToRoute('app_produit_epargne_index', [], Response::HTTP_SEE_OTHER);
    }
}
