<?php

namespace App\Controller\Credit;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ApprobationCreditRepository;
use App\Repository\DemandeCreditRepository;
use App\Form\RapportCreditType;
use App\Repository\DecaissementRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\Credit\Filtrer\Traitement;
use App\Form\FicheCreditModalType;

use function PHPSTORM_META\type;

class RapportCreditController extends AbstractController
{

    #[Route('/rapport/credit/approuver', name: 'app_rapport_credit_approuver')]
    public function approuver(ApprobationCreditRepository $approRepo,Request $request,Traitement $tr): Response
    {

        $affiche_table = false;
        $listeApprouver = [];
        $date1 = false;
        $date2 = false;
        
        $date_arreter = null;
        $date_debut = null;
        $date_fin = null;
        $form = $this->createForm(RapportCreditType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $affiche_table = true;
            
            $data = $form->getData();
            
            $date_arreter = $data['datearrete'];
            $date_debut = $data['datedebut'];
            $date_fin = $data['datefin'];

            $liste = $tr->filtreApprobation($date_arreter,$date_debut,$date_fin,$approRepo,'approuvé');
            $listeApprouver = $liste['liste'];
            $date1 = $liste['date1'];
            $date2 = $liste['date2'];
        }


       // $listeApprouver = $approRepo->findDemandeNonApprouver();
       // dd($listeApprouver);
        return $this->renderForm('Module_credit/rapportCredit/demande_approuver.html.twig',[
            'listes' => $listeApprouver,
            'affiche_table' => $affiche_table,
            'form' => $form,
            'date1' => $date1,
            'date2' => $date2,
            'arreter'=> $date_arreter,
            'debut'=> $date_debut,
            'fin'=> $date_fin,
            
        ]);
    }

    #[Route('/rapport/credit/rejeter', name: 'app_rapport_credit_rejeter')]
    public function rejeter(ApprobationCreditRepository $approRepo,Traitement $tr,Request $request): Response
    {

        $affiche_table = false;
        $listeRejeter = [];
        $date1 = false;
        $date2 = false;
        
        $date_arreter = null;
        $date_debut = null;
        $date_fin = null;
        $form = $this->createForm(RapportCreditType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $affiche_table = true;
            
            $data = $form->getData();
            
            $date_arreter = $data['datearrete'];
            $date_debut = $data['datedebut'];
            $date_fin = $data['datefin'];

            $liste = $tr->filtreApprobation($date_arreter,$date_debut,$date_fin,$approRepo,'Rejeté');
            $listeRejeter = $liste['liste'];
            $date1 = $liste['date1'];
            $date2 = $liste['date2'];
        }

        return $this->renderForm('Module_credit/rapportCredit/demande_rejeter.html.twig',[
            'listes' => $listeRejeter,
            'affiche_table' => $affiche_table,
            'form' => $form,
            'date1' => $date1,
            'date2' => $date2,
            'arreter'=> $date_arreter,
            'debut'=> $date_debut,
            'fin'=> $date_fin,
        ]);
    }

    #[Route('/rapport/credit/differer', name: 'app_rapport_credit_differer')]
    public function differer(ApprobationCreditRepository $approRepo,Request $request,Traitement $tr): Response
    {
        $affiche_table = false;
        $listeDifferer = [];
        $date1 = false;
        $date2 = false;
        
        $date_arreter = null;
        $date_debut = null;
        $date_fin = null;
        $form = $this->createForm(RapportCreditType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $affiche_table = true;
            
            $data = $form->getData();
            
            $date_arreter = $data['datearrete'];
            $date_debut = $data['datedebut'];
            $date_fin = $data['datefin'];

            $liste = $tr->filtreApprobation($date_arreter,$date_debut,$date_fin,$approRepo,'Différée');
            $listeDifferer = $liste['liste'];
            $date1 = $liste['date1'];
            $date2 = $liste['date2'];
        }
        return $this->renderForm('Module_credit/rapportCredit/demande_differer.html.twig',[
            'listes' => $listeDifferer,
            'affiche_table' => $affiche_table,
            'form' => $form,
            'date1' => $date1,
            'date2' => $date2,
            'arreter'=> $date_arreter,
            'debut'=> $date_debut,
            'fin'=> $date_fin,
        ]);
    }

    #[Route('/rapport/demande/credit', name: 'app_rapport_demande_credit')]
    public function demandeCredit(DemandeCreditRepository $repoDemande,Request $request): Response
    {
        $affiche_table = false;
        $date1 = false;
        $date2 = false;
        
        $date_arreter = null;
        $date_debut = null;
        $date_fin = null;

        $form=$this->createForm(RapportCreditType::class);
        $form->handleRequest($request);
        $afficher_table = false;

        $rapportDemande = [];


        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $affiche_table = true;
            
            $data = $form->getData();
            
            $date_arreter = $data['datearrete'];
            $date_debut = $data['datedebut'];
            $date_fin = $data['datefin'];

    
            if ($date_arreter != null) {
                $date1 = true;
                $rapportDemande = $repoDemande->findDemnadeCreditOne($date_arreter); 
            }elseif ($date_debut !=  null && $date_fin != null) {
                $date2= true;
                $rapportDemande = $repoDemande->findDemnadeCredit($date_debut,$date_fin); 
               // dd($rapportDemande); 
            }
            else {
                $affiche_table = false;
            };
        }
        //dd($rapportDemande);
        return $this->renderForm('Module_credit/rapportCredit/demande_credit.html.twig',[
            'listes' => $rapportDemande,
            'form'=>$form,
            'affiche_table' => $affiche_table,
            'form' => $form,
            'date1' => $date1,
            'date2' => $date2,
            'arreter'=> $date_arreter,
            'debut'=> $date_debut,
            'fin'=> $date_fin,
        ]);
    }

    #[Route('/rapport/credit/decaissement/', name: 'app_rapport_credit_decaissement')]
    public function decaissement(DecaissementRepository $decaissementRepository): Response
    {
        $listeDecaissement = $decaissementRepository->rapportDecaissement();
        //dd($listeDecaissement);
        return $this->render('Module_credit/rapportCredit/decaissement.html.twig',[
            'listeDecaisser' => $listeDecaissement,
        ]);
    }

    /**
     * Fiche de credit
     *
     * @param Request $request
     * @param DemandeCreditRepository $demandeCreditRepository
     * @return void
     */
    #[Route('/FicheCredit/Credit/',name:'app_fiche_credit')]
    public function FicheCredit(Request $request,DemandeCreditRepository $demandeCreditRepository)
    {  
        // Recuperer les donnees venant du modal

        $NumeroCredit=$request->query->get('NumeroCredit');
        $NomClient=$request->query->get('NomClient');
        $PrenomClient=$request->query->get('PrenomClient');
        $Codecredit=$request->query->get('Codecredit');

        $Fiche=$demandeCreditRepository->FicheCredit($NumeroCredit);
        

        return $this->render('Module_credit/rapportCredit/FicheCredit.html.twig',[
            'Codecredit'=>$Codecredit,
            'NomClient'=>$NomClient,
            'NumeroCredit'=>$NumeroCredit,
            'PrenomClient'=>$PrenomClient,
            'Fiche'=>$Fiche
        ]);
    }
}