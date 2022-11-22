<?php

namespace App\Controller;

use App\Entity\CompteEpargne;
use App\Entity\ProduitEpargne;
use App\Form\FiltreRapportSoldeType;
use App\Form\FiltreReleveType;
use App\Form\RapportcompteepargnetrieType;
use App\Form\RapportSoldeDuJourType;
use App\Repository\AgenceRepository;
use App\Repository\CompteEpargneRepository;
use App\Repository\GroupeRepository;
use App\Repository\TransactionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RapportController extends AbstractController
{

    #[Route('/rapport', name: 'app_transac_liste')]
    public function index(Request $request,CompteEpargneRepository $compteEpargneRepository,AgenceRepository $agenceRepos): Response
    {     
        $rapporttransaction=$compteEpargneRepository->rapportsolde();

        // Filtre entre deux date

        $showTable_ = false;

        $form1=$this->createForm(FiltreRapportSoldeType::class);
        $rapportsolde=$form1->handleRequest($request);

        if ($form1->isSubmitted() && $form1->isValid()){
            $showTable_ = true;

            if ($rapportsolde->getData()['date1']) {
               
                $rapporttransaction=$compteEpargneRepository->FiltreSoldeArrete(
                    $rapportsolde->getData()['date1'],
                );
                
            }
            else {
                $rapporttransaction=$compteEpargneRepository->FiltreRapportSolde(
                    $rapportsolde->getData()['Du'],
                    $rapportsolde->getData()['Au']
                );
            }
          
        }

        // Filtre pandant une journee
        return $this->renderForm('rapport/RapportSolde.html.twig', [
            'compte_epargnes' =>$rapporttransaction,
            'agences'=>$agenceRepos->findAll(),
            'form1'=>$form1,
            'showTable' => $showTable_,
        ]);
    }

    // Releve transaction
    #[Route('/Releve', name: 'app_transaction_releve')]
    public function Releve(Request $request,AgenceRepository $agenceRepository,TransactionRepository $transactionRepository): Response
    {
        $releve=$transactionRepository->ReleveTransaction();

        $form=$this->createForm(FiltreReleveType::class);
        $filtrereleve = $form->handleRequest($request);

        $showTable_=false;

        if($form->isSubmitted() && $form->isValid()){

            $showTable_=true;
            $releve=$transactionRepository->filtreReleve(
                $filtrereleve->getData()['Du'],
                $filtrereleve->getData()['Au'],
                $filtrereleve->getData()['Codeclient']
            );
        }

        return $this->renderForm('rapport/relevetransaction.html.twig', [
            'agences' =>$agenceRepository->findAll(),
            'releves'=>$releve,
            'form'=>$form,
            'showTable'=>$showTable_
        ]);
    }  

        // rapport compte epargne
    #[Route('/CompteEpargne',name:'app_rapport_compte')]
    public function rapport_compteepargne(Request $request,CompteEpargneRepository $compteEpargneRepository):Response
    {

        $rapport_compteepargne=$compteEpargneRepository->rapport_compte_epargne();
        
        $compteepargne = new CompteEpargne();
        $form=$this->createForm(RapportcompteepargnetrieType::class);
        $filtrecompteep=$form->handleRequest($request);

        $showTable_=false;

        if($form->isSubmitted() && $form->isValid()){
            $showTable_=true;

            if($filtrecompteep->getData()['datearrete']){

                $rapport_compteepargne=$compteEpargneRepository->rapport_compte_epargne_arrete(
                    $filtrecompteep->getData()['datearrete']
                );

            }
            else{

                $rapport_compteepargne=$compteEpargneRepository->rapport_compte_epargne_triedate(
                    $filtrecompteep->getData()['datedebut'],
                    $filtrecompteep->getData()['datefin'],
                );
                
            }

        }

        return  $this->renderForm('rapport/rapport_compte_epargne.html.twig',[
            'rapportcompteep'=>$rapport_compteepargne,
            'showTable'=>$showTable_,
            'form'=>$form,
            'compteepargne'=>$compteepargne
        ]);
    }
 
 }