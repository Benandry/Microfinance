<?php

namespace App\Controller\configurationCredit;

use App\Entity\ProduitCredit;
use App\Form\ProduitCreditType;
use App\Repository\ProduitCreditRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produit/credit')]
class ProduitCreditController extends AbstractController
{
    #[Route('/', name: 'app_produit_credit_index', methods: ['GET'])]
    public function index(ProduitCreditRepository $produitCreditRepository): Response
    {
        return $this->render('produit_credit/index.html.twig', [
            'produit_credits' => $produitCreditRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_produit_credit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProduitCreditRepository $produitCreditRepository): Response
    {
        $produitCredit = new ProduitCredit();
        $form = $this->createForm(ProduitCreditType::class, $produitCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produitCreditRepository->add($produitCredit, true);

            $this->addFlash('success', " Ajout de ".$produitCredit->getNomProduitCredit()." avec success !");
            
        }

        return $this->renderForm('produit_credit/new.html.twig', [
            'produit_credit' => $produitCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produit_credit_show', methods: ['GET'])]
    public function show(ProduitCredit $produitCredit): Response
    {
        return $this->render('produit_credit/show.html.twig', [
            'produit_credit' => $produitCredit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_produit_credit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProduitCredit $produitCredit, ProduitCreditRepository $produitCreditRepository): Response
    {
        $form = $this->createForm(ProduitCreditType::class, $produitCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produitCreditRepository->add($produitCredit, true);

            return $this->redirectToRoute('app_produit_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit_credit/edit.html.twig', [
            'produit_credit' => $produitCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produit_credit_delete', methods: ['POST'])]
    public function delete(Request $request, ProduitCredit $produitCredit, ProduitCreditRepository $produitCreditRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produitCredit->getId(), $request->request->get('_token'))) {
            $produitCreditRepository->remove($produitCredit, true);
        }

        return $this->redirectToRoute('app_produit_credit_index', [], Response::HTTP_SEE_OTHER);
    }
}
