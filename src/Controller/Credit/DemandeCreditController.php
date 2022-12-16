<?php

namespace App\Controller\Credit;

use App\Entity\DemandeCredit;
use App\Form\DemandeCreditType;
use App\Repository\DemandeCreditRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/demande/credit')]
class DemandeCreditController extends AbstractController
{
    #[Route('/', name: 'app_demande_credit_index', methods: ['GET'])]
    public function index(DemandeCreditRepository $demandeCreditRepository): Response
    {
        return $this->render('demande_credit/index.html.twig', [
            'demande_credits' => $demandeCreditRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_demande_credit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DemandeCreditRepository $demandeCreditRepository): Response
    {
        $demandeCredit = new DemandeCredit();
        $form = $this->createForm(DemandeCreditType::class, $demandeCredit);
        $form->handleRequest($request);

        $user = $this->getUser();
        $roles = $user->getRoles();
        //dd($roles);

        if ($form->isSubmitted() && $form->isValid()) {

           $data = $form->getData();
           $montant = $demandeCredit->getMontant();
           $tranche =  $demandeCredit->getNombreTranche();
           $taux =  $demandeCredit->getTauxInteretAnnuel();
           $codeclient =  $demandeCredit->getCodeclient();
           $demandeCredit->setStatusApp("en attente ");

           //dd($codeclient);
           $demandeCreditRepository->add($demandeCredit, true);

           //dd($data->getTypeAmortissement());

           if($data->getTypeAmortissement() == "simple")
           {
                return $this->redirectToRoute('app_tableau_amortissement', [
                    'montant' => $montant,
                    'tranche' => $tranche,
                    'taux' => $taux,
                    'codeclient' => $codeclient,
                ], Response::HTTP_SEE_OTHER);
           }
           elseif($data->getTypeAmortissement() == "anuuite constante")
           {
                return $this->redirectToRoute('app_tableau_amortissement_annuite_constante', [
                    'montant' => $montant,
                    'tranche' => $tranche,
                    'taux' => $taux,
                    'codeclient' => $codeclient,
                ], Response::HTTP_SEE_OTHER);
           }
           else
           {
                return $this->redirectToRoute('app_tableau_amortissement_remboursement_constante', [
                    'montant' => $montant,
                    'tranche' => $tranche,
                    'taux' => $taux,
                    'codeclient' => $codeclient,
                ], Response::HTTP_SEE_OTHER);
           }
           
           
        }

        // Recupere la derniere ID pour creer la numero credit

        $numeroCredit=$demandeCreditRepository->DernierNumeroCredit();

        if($numeroCredit[0][1] == NULL){
            $numero = 0;
        }
        else{
            $numero=$numeroCredit[0][1];
        }


        return $this->renderForm('demande_credit/new.html.twig', [
            'demande_credit' => $demandeCredit,
            'numeros'=>$numero,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demande_credit_show', methods: ['GET'])]
    public function show(DemandeCredit $demandeCredit): Response
    {
        return $this->render('demande_credit/show.html.twig', [
            'demande_credit' => $demandeCredit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_demande_credit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DemandeCredit $demandeCredit, DemandeCreditRepository $demandeCreditRepository): Response
    {
        $form = $this->createForm(DemandeCreditType::class, $demandeCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $demandeCreditRepository->add($demandeCredit, true);

            return $this->redirectToRoute('app_demande_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('demande_credit/edit.html.twig', [
            'demande_credit' => $demandeCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demande_credit_delete', methods: ['POST'])]
    public function delete(Request $request, DemandeCredit $demandeCredit, DemandeCreditRepository $demandeCreditRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demandeCredit->getId(), $request->request->get('_token'))) {
            $demandeCreditRepository->remove($demandeCredit, true);
        }

        return $this->redirectToRoute('app_demande_credit_index', [], Response::HTTP_SEE_OTHER);
    }
}
