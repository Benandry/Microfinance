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
    #[Route('/individuel', name: 'app_approbation_credit_individuel', methods: ['GET'])]
    public function individuel(ApprobationCreditRepository $approbationCreditRepository): Response
    {
        $demandes = $approbationCreditRepository->findDemandeNonApprouver();
        //dd($demandes);
        
        return $this->render('Module_credit/approbation_credit/individuel.html.twig', [
            'demandes' => $demandes,
            'approbation_credits' => $approbationCreditRepository->findAll(),
        ]);
    }

    #[Route('/groupe', name: 'app_approbation_credit_groupe', methods: ['GET'])]
    public function groupe(ApprobationCreditRepository $approbationCreditRepository): Response
    {
        $demandes = $approbationCreditRepository->findDemandeNonApprouverGroupe();
        // dd($demandes);
        
        return $this->render('Module_credit/approbation_credit/groupe.html.twig', [
            'demandes' => $demandes,
            'approbation_credits' => $approbationCreditRepository->findAll(),
        ]);
    }

    #[Route('/new/individuel', name: 'app_approbation_credit_new_individuel', methods: ['GET', 'POST'])]
    public function newIndividuel(Request $request, ApprobationCreditRepository $approbationCreditRepository): Response
    {
        $demande = $request->query->all();

        $codeclient = $demande['demande']['codeclient'];
        $cycles = $approbationCreditRepository->findCycle($codeclient)[0][1];
        $approbationCredit = new ApprobationCredit();
        $form = $this->createForm(ApprobationCreditType::class, $approbationCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $approbationCreditRepository->add($approbationCredit, true);
            $this->addFlash('success', "Le demande de credit ".$approbationCredit->getCodecredit()." est ".$approbationCredit->getStatusApprobation());
            return $this->redirectToRoute('app_approbation_credit_individuel', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_credit/approbation_credit/approIndividuel.html.twig', [
            'approbation_credit' => $approbationCredit,
            'demandes' => $demande,
            'form' => $form,
            'cycle' =>$cycles,
        ]);
    }

    #[Route('/new/groupe', name: 'app_approbation_credit_new_groupe', methods: ['GET', 'POST'])]
    public function newGroupe(Request $request, ApprobationCreditRepository $approbationCreditRepository): Response
    {
        $demande = $request->query->all();
        // dd($demande);
        $codeclient = $demande['demande']['codeclient'];
        $cycles = $approbationCreditRepository->findCycle($codeclient)[0][1];
        
        $approbationCredit = new ApprobationCredit();
        $form = $this->createForm(ApprobationCreditType::class, $approbationCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $approbationCreditRepository->add($approbationCredit, true);
            $this->addFlash('success', "Le demande de credit ".$approbationCredit->getCodecredit()." est ".$approbationCredit->getStatusApprobation());
            return $this->redirectToRoute('app_approbation_credit_groupe', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_credit/approbation_credit/approGroupe.html.twig', [
            'approbation_credit' => $approbationCredit,
            'demandes' => $demande,
            'form' => $form,
            'cycle' =>$cycles,
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

            return $this->redirectToRoute('app_approbation_credit_individuel', [], Response::HTTP_SEE_OTHER);
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

        return $this->redirectToRoute('app_approbation_credit_individuel', [], Response::HTTP_SEE_OTHER);
    }
}
