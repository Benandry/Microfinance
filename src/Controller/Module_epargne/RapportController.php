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
use App\Repository\IndividuelclientRepository;
use App\Repository\ProduitEpargneRepository;
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
        $soldeinitiale = 0;
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

            // Solde initialise 
            if ($transactionRepository->findSoldeInitial($du,$Codeclient)) {
                $soldeinitiale = $transactionRepository->findSoldeInitial($du,$Codeclient)[0]['solde'];
                # code...
            }else {
                $soldeinitiale = 0;
            }
        }

        return $this->renderForm('rapport/relevetransaction.html.twig', [
            'agences' =>$agenceRepository->findAll(),
            'releves'=>$releve,
            'form'=>$form,
            'showTable'=>$showTable_,
            'du' =>$du,
            'au'=> $au,
            'info'=>$client,
            'solde_initial' => $soldeinitiale
        ]);
    }  

        // rapport compte epargne
    #[Route('/Rapport/CompteEpargne',name:'app_rapport_compte')]
    public function rapport_compteepargne(Request $request,CompteEpargneRepository $compteEpargneRepository):Response
    {

        $compteepargne = new CompteEpargne();
        $form=$this->createForm(RapportcompteepargnetrieType::class);

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            return $this->redirectToRoute('app_rapport_compte_epargne_by_data',['data' => $data],Response::HTTP_SEE_OTHER);

        }
        // dd($agence);

        return  $this->renderForm('Module_epargne/rapport/modal.html.twig',[
            'form'=>$form,
            'compteepargne'=>$compteepargne,
        ]);
    }

    #[Route('Rapport/compte/epargne/data',name:'app_rapport_compte_epargne_by_data',methods:['POST','GET'])]
    public function getData(Request $request,CompteEpargneRepository $compteEpargneRepository,
    ProduitEpargneRepository $produitEpargneRepository,IndividuelclientRepository $individuelclientRepository,
    GroupeRepository $groupeRepository,AgenceRepository $agenceRepository):Response
    {
        $data = $request->query->get('data');
        
        /***PAr type de produits */
        if(isset($data['type'])){
            $type = $produitEpargneRepository->find($data['type']);
            $titre = $type->getNomproduit()." ".$type->getAbbreviation();
            $report = $compteEpargneRepository->findCompteEpargneByProduit($type->getId());
            $trier = "produit";
        }
        //Individuel client //
        elseif(isset($data['individuel'])) {
            $individuel = $individuelclientRepository->find($data['individuel']);
            $titre = $individuel->getNomClient().' '.$individuel->getPrenomClient();
            $report=$compteEpargneRepository->findCompteEpargneByClient($individuel->getCodeclient());
            $trier = "individuel";
        }
        //Gtroupe client //
        elseif (isset($data['groupe'])) {
            $groupe = $groupeRepository->find($data['groupe']);
            $titre = $groupe->getNomGroupe();
            $report=$compteEpargneRepository->findCompteEpargneByClient($groupe->getCodegroupe());
            $trier = "groupe";
        }
        //Par agence 
        elseif (isset($data['agence'])) {
            $agence = $agenceRepository->find($data['agence']);
            $titre = "Agence ".$agence->getNomAgence();
            $report=$compteEpargneRepository->findCompteEpargneByAgence($agence->getId());
            $trier = "agence";
        }
        //Limiter par un date 
        elseif (isset($data['datearrete'])){
            $date1 = $data['datearrete'];
            $report=$compteEpargneRepository->rapport_compte_epargne_arrete($date1);
        }
        //Entrer deux periode
        elseif (isset($data['datedebut']) and isset($data['datefin'])) {
            $report=$compteEpargneRepository->rapport_compte_epargne_triedate($data['datedebut'],$data['datefin']); 
        }
        else {
            $report = $compteEpargneRepository->findCompteEpargneAll();
            $trier = "agence";
        }

        return $this->render('Module_epargne/rapport/index.html.twig',[
            'compte_epargne' => $report,
            "titre" => $titre,
            "trier" => $trier
        ]);
    }
 }