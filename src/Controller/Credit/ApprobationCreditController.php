<?php

namespace App\Controller\Credit;

use App\Entity\ApprobationCredit;
use App\Form\ApprobationCreditType;
use App\Repository\ApprobationCreditRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/approbation/credit')]
class ApprobationCreditController extends AbstractController
{
    #[Route('/', name: 'app_approbation_credit_index', methods: ['GET'])]
    public function index(ApprobationCreditRepository $approbationCreditRepository): Response
    {
        $demandes = $approbationCreditRepository->findDemandeNonApprouver();
        //dd($demandes);
        
        return $this->render('Module_credit/approbation_credit/index.html.twig', [
            'demandes' => $demandes,
            'approbation_credits' => $approbationCreditRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_approbation_credit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ApprobationCreditRepository $approbationCreditRepository): Response
    {
        $demande = $request->query->all();

        $approbationCredit = new ApprobationCredit();
        $form = $this->createForm(ApprobationCreditType::class, $approbationCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd($form->getData());
            $approbationCreditRepository->add($approbationCredit, true);

            return $this->redirectToRoute('app_approbation_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_credit/approbation_credit/new.html.twig', [
            'approbation_credit' => $approbationCredit,
            'demandes' => $demande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_approbation_credit_show', methods: ['GET'])]
    public function show(ApprobationCredit $approbationCredit): Response
    {
        return $this->render('Module_credit/approbation_credit/show.html.twig', [
            'approbation_credit' => $approbationCredit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_approbation_credit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ApprobationCredit $approbationCredit, ApprobationCreditRepository $approbationCreditRepository): Response
    {
        $form = $this->createForm(ApprobationCreditType::class, $approbationCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $approbationCreditRepository->add($approbationCredit, true);

            return $this->redirectToRoute('app_approbation_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_credit/approbation_credit/edit.html.twig', [
            'approbation_credit' => $approbationCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_approbation_credit_delete', methods: ['POST'])]
    public function delete(Request $request, ApprobationCredit $approbationCredit, ApprobationCreditRepository $approbationCreditRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$approbationCredit->getId(), $request->request->get('_token'))) {
            $approbationCreditRepository->remove($approbationCredit, true);
        }

        return $this->redirectToRoute('app_approbation_credit_index', [], Response::HTTP_SEE_OTHER);
    }
}
