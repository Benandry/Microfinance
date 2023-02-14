<?php

namespace App\Controller\Module_epargne;

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
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
        $data = '';

        $form1=$this->createFormBuilder()
            ->add('date1',DateType::class,[
                'widget'=>'single_text',
                'label'=> false,
            ])
            ->getForm();

        $form1->handleRequest($request);

        if ($form1->isSubmitted() && $form1->isValid()){
            $showTable_ = true;
            $data = $form1->getData()['date1'];
            $rapporttransaction=$compteEpargneRepository->FiltreSoldeArrete($data); 
        }

        return $this->renderForm('rapport/RapportSolde.html.twig', [
            'compte_epargnes' =>$rapporttransaction,
            'agences'=>$agenceRepos->findAll(),
            'form1'=>$form1,
            'showTable' => $showTable_,
            'one_date' => $data,
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
        /************Date **** */
        $du = 0;
        $au = 0;
        $client = '';
        /******* */

        if($form->isSubmitted() && $form->isValid()){

            /**Information client */
            // dd($filtrereleve->getData()['Codeclient']->getCodeep());
            $client = $transactionRepository->findClientByNumero($filtrereleve->getData()['Codeclient']->getCodeep())[0];
            $showTable_=true;
            $data = $filtrereleve->getData();
            $du = $data['Du'];
            $au = $data['Au'];
            $Codeclient = $filtrereleve->getData()['Codeclient']->getCodeepargne();
            
            $releve=$transactionRepository->filtreReleve($du,$au,$Codeclient);
            // dd($releve);
        }

        return $this->renderForm('rapport/relevetransaction.html.twig', [
            'agences' =>$agenceRepository->findAll(),
            'releves'=>$releve,
            'form'=>$form,
            'showTable'=>$showTable_,
            'du' =>$du,
            'au'=> $au,
            'info'=>$client
        ]);
    }  

        // rapport compte epargne
    #[Route('/CompteEpargne',name:'app_rapport_compte')]
    public function rapport_compteepargne(Request $request,CompteEpargneRepository $compteEpargneRepository):Response
    {

        $rapport_compteepargne=$compteEpargneRepository->rapport_compte_epargne();

        $compteepargne = new CompteEpargne();
        $form=$this->createForm(RapportcompteepargnetrieType::class);

        $form->handleRequest($request);

        $showTable_=false;

        
        $date_du_ = '';
        $date_au_ = '';
        $date1 = '';
        $date_2 = false;
        $date_1 = false;

        if($form->isSubmitted() && $form->isValid()){
            $showTable_=true;

            $data = $form->getData();
            $date_du_ = $data['datedebut'];
            $date_au_ = $data['datefin'];
            $date1 = $data['datearrete'];

           
            if ($date1 != null){
                $date_1 = true;
                $rapport_compteepargne=$compteEpargneRepository->rapport_compte_epargne_arrete($date1);
                // dd($rapport_compteepargne);
            }
            else{
                $date_2 = true;
                $rapport_compteepargne=$compteEpargneRepository->rapport_compte_epargne_triedate($date_du_,$date_au_);   
            }

        }
        // dd($rapport_compteepargne);

        return  $this->renderForm('rapport/rapport_compte_epargne.html.twig',[
            'rapportcompteep'=>$rapport_compteepargne,
            'showTable'=>$showTable_,
            'form'=>$form,
            'compteepargne'=>$compteepargne,
            'du' => $date_du_,
            'au' => $date_au_,
            'one_date' => $date1,
            'date_1' => $date_1,
            'date_2' => $date_2,
        ]);
    }
 
 }