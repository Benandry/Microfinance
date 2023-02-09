<?php

namespace App\Controller\Credit;

use App\Entity\PenaliteCredit;
use App\Form\PenaliteCreditType;
use App\Repository\PenaliteCreditRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/penalite/credit')]
class PenaliteCreditController extends AbstractController
{
    #[Route('/', name: 'app_penalite_credit_index', methods: ['GET'])]
    public function index(PenaliteCreditRepository $penaliteCreditRepository): Response
    {
        return $this->render('penalite_credit/index.html.twig', [
            'penalite_credits' => $penaliteCreditRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_penalite_credit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PenaliteCreditRepository $penaliteCreditRepository): Response
    {
        $penaliteCredit = new PenaliteCredit();
        $form = $this->createForm(PenaliteCreditType::class, $penaliteCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $penaliteCreditRepository->save($penaliteCredit, true);

            return $this->redirectToRoute('app_penalite_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('penalite_credit/new.html.twig', [
            'penalite_credit' => $penaliteCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_penalite_credit_show', methods: ['GET'])]
    public function show(PenaliteCredit $penaliteCredit): Response
    {
        return $this->render('penalite_credit/show.html.twig', [
            'penalite_credit' => $penaliteCredit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_penalite_credit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PenaliteCredit $penaliteCredit, PenaliteCreditRepository $penaliteCreditRepository): Response
    {
        $form = $this->createForm(PenaliteCreditType::class, $penaliteCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $penaliteCreditRepository->save($penaliteCredit, true);

            return $this->redirectToRoute('app_penalite_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('penalite_credit/edit.html.twig', [
            'penalite_credit' => $penaliteCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_penalite_credit_delete', methods: ['POST'])]
    public function delete(Request $request, PenaliteCredit $penaliteCredit, PenaliteCreditRepository $penaliteCreditRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$penaliteCredit->getId(), $request->request->get('_token'))) {
            $penaliteCreditRepository->remove($penaliteCredit, true);
        }

        return $this->redirectToRoute('app_penalite_credit_index', [], Response::HTTP_SEE_OTHER);
    }
}
