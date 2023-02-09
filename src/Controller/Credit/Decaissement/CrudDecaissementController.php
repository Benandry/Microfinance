<?php

namespace App\Controller\Credit\Decaissement;

use App\Controller\Comptabilite\TraitementCompta\ComptaDecaissement;
use App\Entity\Decaissement;
use App\Form\DecaissementType;
use App\Repository\DecaissementRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('decaissement/credit/crud')]
class CrudDecaissementController extends AbstractController
{
    #[Route('/', name: 'app_crud_decaissement_index', methods: ['GET'])]
    public function index(DecaissementRepository $decaissementRepository): Response
    {
        return $this->render('crud_decaissement/index.html.twig', [
            'decaissements' => $decaissementRepository->findAll(),
        ]);
    }

    #[Route('/new/individuel', name: 'app_crud_decaissement_new_individuel', methods: ['GET', 'POST'])]
    public function individuel(ManagerRegistry $doctrine, Request $request, DecaissementRepository $decaissementRepository,ComptaDecaissement $compta): Response
    {
        $demandeApprouver = $request->query->all();
        $decaissement = new Decaissement();
        // dd($demandeApprouver);

        $codecredit = $demandeApprouver['liste']['codeclient'];

        $cycle = $decaissementRepository->findByCycle($codecredit)[0][1];

        $form = $this->createForm(DecaissementType::class, $decaissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Reference de decaissement
<<<<<<< HEAD

            // dd($decaissement->getNumeroCredit());
=======
>>>>>>> refs/remotes/origin/main
            $decaissement->setRefDecaissement(random_int(2,1000000000));

            $em=$doctrine->getManager();
            
            $debit = $form->get('debit')->getData();
            $credit = $form->get('credit')->getData();
            // dd($debit);
            $compta->decaissement($em,$decaissement,$debit,$credit);

            $decaissementRepository->add($decaissement, true);
            $this->addFlash('success', "Décaissement de credit  ".$decaissement->getNumeroCredit()." reuissite .Réferences : ".$decaissement->getRefDecaissement());
            return $this->redirectToRoute('app_decaissement_credit_individuel', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_credit/crud_decaissement/individuel.html.twig', [
            'decaissement' => $decaissement,
            'form' => $form,
            'demandes' => $demandeApprouver,
            'cycle' => $cycle
        ]);
    }

    #[Route('/new/groupe', name: 'app_crud_decaissement_new_groupe', methods: ['GET', 'POST'])]
    public function groupe(ManagerRegistry $doctrine, ComptaDecaissement $compta, Request $request, DecaissementRepository $decaissementRepository): Response
    {
        $demandeApprouver = $request->query->all();
        $decaissement = new Decaissement();
        $codecredit = $demandeApprouver['liste']['codeclient'];
        
        $cycle = $decaissementRepository->findByCycle($codecredit)[0][1];

        $form = $this->createForm(DecaissementType::class, $decaissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Reference de decaissement
<<<<<<< HEAD

            dd($decaissement);
=======
>>>>>>> refs/remotes/origin/main
            $decaissement->setRefDecaissement(random_int(2,1000000000));

            $em=$doctrine->getManager();
            
            $debit = $form->get('debit')->getData();
            $credit = $form->get('credit')->getData();
            $compta->decaissement($em,$decaissement,$debit,$credit);

            $decaissementRepository->add($decaissement, true);
            $this->addFlash('success', " Decaissement de credit ".$decaissement->getNumeroCredit()." reuissite ");
            return $this->redirectToRoute('app_decaissement_credit_groupe', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_credit/crud_decaissement/groupe.html.twig', [
            'decaissement' => $decaissement,
            'form' => $form,
            'demandes' => $demandeApprouver,
            'cycle' => $cycle
        ]);
    }

    #[Route('/{id}', name: 'app_crud_decaissement_show', methods: ['GET'])]
    public function show(Decaissement $decaissement): Response
    {
        return $this->render('crud_decaissement/show.html.twig', [
            'decaissement' => $decaissement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_crud_decaissement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Decaissement $decaissement, DecaissementRepository $decaissementRepository): Response
    {
        $form = $this->createForm(DecaissementType::class, $decaissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $decaissementRepository->add($decaissement, true);

            return $this->redirectToRoute('app_crud_decaissement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud_decaissement/edit.html.twig', [
            'decaissement' => $decaissement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_crud_decaissement_delete', methods: ['POST'])]
    public function delete(Request $request, Decaissement $decaissement, DecaissementRepository $decaissementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$decaissement->getId(), $request->request->get('_token'))) {
            $decaissementRepository->remove($decaissement, true);
        }

        return $this->redirectToRoute('app_crud_decaissement_index', [], Response::HTTP_SEE_OTHER);
    }
}
