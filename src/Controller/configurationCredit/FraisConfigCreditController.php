<?php

namespace App\Controller\configurationCredit;

use App\Entity\FraisConfigCredit;
use App\Form\FraisConfigCreditType;
use App\Repository\FraisConfigCreditRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/frais/config/credit')]
class FraisConfigCreditController extends AbstractController
{
    #[Route('/', name: 'app_frais_config_credit_index', methods: ['GET'])]
    public function index(FraisConfigCreditRepository $fraisConfigCreditRepository): Response
    {
        return $this->render('frais_config_credit/index.html.twig', [
            'frais_config_credits' => $fraisConfigCreditRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_frais_config_credit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FraisConfigCreditRepository $fraisConfigCreditRepository): Response
    {
        $fraisConfigCredit = new FraisConfigCredit();
        $form = $this->createForm(FraisConfigCreditType::class, $fraisConfigCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fraisConfigCreditRepository->add($fraisConfigCredit, true);

            $this->addFlash('success', "Configuration frais credit !");
        }

        return $this->renderForm('frais_config_credit/new.html.twig', [
            'frais_config_credit' => $fraisConfigCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_frais_config_credit_show', methods: ['GET'])]
    public function show(FraisConfigCredit $fraisConfigCredit): Response
    {
        return $this->render('frais_config_credit/show.html.twig', [
            'frais_config_credit' => $fraisConfigCredit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_frais_config_credit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FraisConfigCredit $fraisConfigCredit, FraisConfigCreditRepository $fraisConfigCreditRepository): Response
    {
        $form = $this->createForm(FraisConfigCreditType::class, $fraisConfigCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fraisConfigCreditRepository->add($fraisConfigCredit, true);

            return $this->redirectToRoute('app_frais_config_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('frais_config_credit/edit.html.twig', [
            'frais_config_credit' => $fraisConfigCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_frais_config_credit_delete', methods: ['POST'])]
    public function delete(Request $request, FraisConfigCredit $fraisConfigCredit, FraisConfigCreditRepository $fraisConfigCreditRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fraisConfigCredit->getId(), $request->request->get('_token'))) {
            $fraisConfigCreditRepository->remove($fraisConfigCredit, true);
        }

        return $this->redirectToRoute('app_frais_config_credit_index', [], Response::HTTP_SEE_OTHER);
    }
}
