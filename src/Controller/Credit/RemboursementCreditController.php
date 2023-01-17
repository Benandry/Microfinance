<?php

namespace App\Controller\Credit;

use App\Entity\RemboursementCredit;
use App\Form\RemboursementCreditType;
use App\Repository\RemboursementCreditRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/remboursement/credit')]
class RemboursementCreditController extends AbstractController
{
    #[Route('/', name: 'app_remboursement_credit_index', methods: ['GET'])]
    public function index(RemboursementCreditRepository $remboursementCreditRepository): Response
    {
        return $this->render('remboursement_credit/index.html.twig', [
            'remboursement_credits' => $remboursementCreditRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_remboursement_credit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RemboursementCreditRepository $remboursementCreditRepository): Response
    {   
        // Recuperation du code credit
        $codecredit=$request->query->get('codecredit');

        $remboursementCredit = new RemboursementCredit();

        $form = $this->createForm(RemboursementCreditType::class, $remboursementCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $remboursementCreditRepository->save($remboursementCredit, true);

            $this->addFlash('success','Remboursement de credit reussi !');
            // return $this->redirectToRoute('app_remboursement_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('remboursement_credit/new.html.twig', [
            'codecredit'=>$codecredit,
            'remboursement_credit' => $remboursementCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_remboursement_credit_show', methods: ['GET'])]
    public function show(RemboursementCredit $remboursementCredit): Response
    {
        return $this->render('remboursement_credit/show.html.twig', [
            'remboursement_credit' => $remboursementCredit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_remboursement_credit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RemboursementCredit $remboursementCredit, RemboursementCreditRepository $remboursementCreditRepository): Response
    {
        $form = $this->createForm(RemboursementCreditType::class, $remboursementCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $remboursementCreditRepository->save($remboursementCredit, true);

            return $this->redirectToRoute('app_remboursement_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('remboursement_credit/edit.html.twig', [
            'remboursement_credit' => $remboursementCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_remboursement_credit_delete', methods: ['POST'])]
    public function delete(Request $request, RemboursementCredit $remboursementCredit, RemboursementCreditRepository $remboursementCreditRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$remboursementCredit->getId(), $request->request->get('_token'))) {
            $remboursementCreditRepository->remove($remboursementCredit, true);
        }

        return $this->redirectToRoute('app_remboursement_credit_index', [], Response::HTTP_SEE_OTHER);
    }
}
