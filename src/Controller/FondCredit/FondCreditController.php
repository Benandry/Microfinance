<?php

namespace App\Controller\FondCredit;

use App\Entity\FondCredit;
use App\Form\FondCreditType;
use App\Repository\FondCreditRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/fond/credit')]
class FondCreditController extends AbstractController
{
    #[Route('/', name: 'app_fond_credit_index', methods: ['GET'])]
    public function index(FondCreditRepository $fondCreditRepository): Response
    {
        return $this->render('fond_credit/index.html.twig', [
            'fond_credits' => $fondCreditRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_fond_credit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FondCreditRepository $fondCreditRepository): Response
    {
        $fondCredit = new FondCredit();
        $form = $this->createForm(FondCreditType::class, $fondCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fondCreditRepository->add($fondCredit, true);

            return $this->redirectToRoute('app_fond_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fond_credit/new.html.twig', [
            'fond_credit' => $fondCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fond_credit_show', methods: ['GET'])]
    public function show(FondCredit $fondCredit): Response
    {
        return $this->render('fond_credit/show.html.twig', [
            'fond_credit' => $fondCredit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_fond_credit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FondCredit $fondCredit, FondCreditRepository $fondCreditRepository): Response
    {
        $form = $this->createForm(FondCreditType::class, $fondCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fondCreditRepository->add($fondCredit, true);

            return $this->redirectToRoute('app_fond_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fond_credit/edit.html.twig', [
            'fond_credit' => $fondCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fond_credit_delete', methods: ['POST'])]
    public function delete(Request $request, FondCredit $fondCredit, FondCreditRepository $fondCreditRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fondCredit->getId(), $request->request->get('_token'))) {
            $fondCreditRepository->remove($fondCredit, true);
        }

        return $this->redirectToRoute('app_fond_credit_index', [], Response::HTTP_SEE_OTHER);
    }
}
