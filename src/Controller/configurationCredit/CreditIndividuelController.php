<?php

namespace App\Controller\configurationCredit;

use App\Entity\CreditIndividuel;
use App\Form\CreditIndividuelType;
use App\Repository\CreditIndividuelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/credit/individuel')]
class CreditIndividuelController extends AbstractController
{
    #[Route('/', name: 'app_credit_individuel_index', methods: ['GET'])]
    public function index(CreditIndividuelRepository $creditIndividuelRepository): Response
    {
        return $this->render('credit_individuel/index.html.twig', [
            'credit_individuels' => $creditIndividuelRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_credit_individuel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CreditIndividuelRepository $creditIndividuelRepository): Response
    {
        $creditIndividuel = new CreditIndividuel();
        $form = $this->createForm(CreditIndividuelType::class, $creditIndividuel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $creditIndividuelRepository->add($creditIndividuel, true);

            $this->addFlash('success', "Configuration credit individuel reussi !");

        }

        return $this->renderForm('credit_individuel/new.html.twig', [
            'credit_individuel' => $creditIndividuel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_credit_individuel_show', methods: ['GET'])]
    public function show(CreditIndividuel $creditIndividuel): Response
    {
        return $this->render('credit_individuel/show.html.twig', [
            'credit_individuel' => $creditIndividuel,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_credit_individuel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CreditIndividuel $creditIndividuel, CreditIndividuelRepository $creditIndividuelRepository): Response
    {
        $form = $this->createForm(CreditIndividuelType::class, $creditIndividuel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $creditIndividuelRepository->add($creditIndividuel, true);

            return $this->redirectToRoute('app_credit_individuel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('credit_individuel/edit.html.twig', [
            'credit_individuel' => $creditIndividuel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_credit_individuel_delete', methods: ['POST'])]
    public function delete(Request $request, CreditIndividuel $creditIndividuel, CreditIndividuelRepository $creditIndividuelRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$creditIndividuel->getId(), $request->request->get('_token'))) {
            $creditIndividuelRepository->remove($creditIndividuel, true);
        }

        return $this->redirectToRoute('app_credit_individuel_index', [], Response::HTTP_SEE_OTHER);
    }
}
