<?php

namespace App\Controller\Module_epargne;

use App\Entity\CompteEpargne;
use App\Form\FiltreReleveType;
use App\Form\RapportcompteepargnetrieType;
use App\Repository\AgenceRepository;
use App\Repository\CompteEpargneRepository;
use App\Repository\GroupeRepository;
use App\Repository\IndividuelclientRepository;
use App\Repository\ProduitEpargneRepository;
use App\Repository\TransactionRepository;
use DateTime;
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

            $data = $form1->getData()['date1']->format('Y-m-d');

            return $this->redirectToRoute('app_rapport_solde',[
                'begin' => $data['debut']->format('Y-m-d'),
                'end'  =>  $data['fin']->format('Y-m-d'),
            ],Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rapport/RapportSolde.html.twig', [
            'compte_epargnes' =>$rapporttransaction,
            'agences'=>$agenceRepos->findAll(),
            'form1'=>$form1,
            'showTable' => $showTable_,
            'one_date' => $data,
        ]);
    }


    #[Route('/rapport/solde', name: 'app_rapport_solde')]
    public function rapport_solde(Request $request,CompteEpargneRepository $compteEpargneRepository): Response
    {
        
        $data = $request->query->get('data');
        $rapporttransaction=$compteEpargneRepository->FiltreSoldeArrete($data); 
        return $this->render('',[
            'compte_epargnes' => $rapporttransaction,
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

            //We post the one date to filter the reporting loan
            if ($data['date']) {
                $data['arreter'] = $data['date']->format('Y-m-d');
            }

            //We post the one date to filter the reporting loan
            if ($data['debut'] && $data['fin'] ) {
                return $this->redirectToRoute('app_rapport_compte_epargne_by_data',[
                    'begin' => $data['debut']->format('Y-m-d'),
                    'end'  =>  $data['fin']->format('Y-m-d'),
                ],Response::HTTP_SEE_OTHER);

            }


            return $this->redirectToRoute('app_rapport_compte_epargne_by_data',['data' => $data],Response::HTTP_SEE_OTHER);

        }
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
        $begin = $request->query->get('begin');
        $end = $request->query->get('end');
        $date = "";
        /***PAr type de produits */
        if(isset($data['type'])){
            $type = $produitEpargneRepository->find($data['type']);
            $titre = $type->getNomproduit()." ".$type->getAbbreviation();
            $report = $compteEpargneRepository->findCompteEpargneByProduit($type->getId());
            $trier = "produit";
            $date = "";
            $begin = '';
            $end = '';
        }
        //Individuel client //
        elseif(isset($data['individuel'])) {
            $individuel = $individuelclientRepository->find($data['individuel']);
            $titre = $individuel->getNomClient().' '.$individuel->getPrenomClient();
            $report=$compteEpargneRepository->findCompteEpargneByClient($individuel->getCodeclient());
            $trier = "individuel";
            $date = "";
            $begin = '';
            $end = '';
        }
        //Gtroupe client //
        elseif (isset($data['groupe'])) {
            $groupe = $groupeRepository->find($data['groupe']);
            $titre = $groupe->getNomGroupe();
            $report=$compteEpargneRepository->findCompteEpargneByClient($groupe->getCodegroupe());
            $trier = "groupe";
            $date = "";
            $begin = '';
            $end = '';
        }
        //Par agence 
        elseif (isset($data['agence'])) {
            $agence = $agenceRepository->find($data['agence']);
            $titre = "Agence ".$agence->getNomAgence();
            $report=$compteEpargneRepository->findCompteEpargneByAgence($agence->getId());
            $trier = "agence";
            $date = "";
            $begin = '';
            $end = '';
        }
        //Limiter par un date 
        elseif (isset($data['arreter'])){
            $date = $data['arreter'];
            $report=$compteEpargneRepository->rapport_compte_epargne_arrete($date);
            $titre = "jusqu'a : ";
            $trier = "";
            $begin = '';
            $end = '';
        }
        //Entrer deux periode
        elseif (isset($begin) and isset($end)) {
            $report=$compteEpargneRepository->rapport_compte_epargne_triedate($begin,$end); 
            $titre = "";
            $trier = "";
        }
        else {
            $report = $compteEpargneRepository->findCompteEpargneAll();
            $trier = "tous";
            $date = "";
            $begin = '';
            $end = '';
        }

        // dd($date);
        return $this->render('Module_epargne/rapport/index.html.twig',[
            'compte_epargne' => $report,
            "titre" => $titre,
            "trier" => $trier,
            'dateArreter' =>$date,
            'begin' => $begin ,
            'end'  => $end
        ]);
    }
 }