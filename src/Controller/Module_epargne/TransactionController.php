<?php

namespace App\Controller\Module_epargne;

use App\Controller\Comptabilite\TraitementCompta\MouvementEpargne;
use App\Entity\Transaction;
use App\Form\FiltreRapportTransactionType;
use App\Form\TransactionretraitType;
use App\Form\TransactionType;
use App\Repository\AgenceRepository;
use App\Repository\TransactionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/transaction')]
class TransactionController extends AbstractController
{
    /**
     * Function index de la transaction epargne (Depot et retrait)
     *
     * @param Request $request
     * @param AgenceRepository $agenceRepository
     * @param TransactionRepository $transactionRepository
     * @return Response
     */
    #[Route('/', name: 'app_transaction_index')]
    public function index(Request $request,AgenceRepository $agenceRepository,TransactionRepository $transactionRepository): Response
    {
        $transaction=$transactionRepository->RapportTransaction();
        #--------------Date afficher ---------------------------#
        $date_1 = false;
        $date_2 = false;
        $date_du_ = 0;
        $date_au_ = 0;
        $date1 = 0;
        $SommeMontant = 0;

        $titre = "";
        // Filtre entre deux date d'une rapport
        $afficheTab_ = false;
        $form=$this->createForm(FiltreRapportTransactionType::class);
        $rapporttransaction=$form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $afficheTab_ = true;
            $data = $rapporttransaction->getData();
            
            $date1 = $data['date1'];
            $date_du_ = $data['Du'];
            $date_au_ = $data['Au'];

            if ($data['compteEpargne']) {
                $transaction=$transactionRepository->findTransactionByCode($data['compteEpargne']->getCodeepargne());
                $titre = " du client : ".$transaction[0]['nomclient']." ".$transaction[0]['prenomclient'];
                $SommeMontant = array_sum(array_column($transaction,'Montant'));
             }
            elseif ($date1 != null) {
                // En une date ///////////
                $date_1 = true;
                $transaction=$transactionRepository->FiltreDateArreteTransac($date1);
                $SommeMontant = array_sum(array_column($transaction,'Montant'));
                // dd($SommeMontant);
                
            }else{
                // Entre deux dates ///////////
                $date_2 = true;
                $transaction=$transactionRepository->FiltreRapportSolde($date_du_,$date_au_);
                $SommeMontant = array_sum(array_column($transaction,'Montant'));
                // dd($SommeMontant);
            }
        }

        return $this->renderForm('Module_epargne/transaction/DernierTransaction.html.twig', [
            'agences' => $agenceRepository->findAll(),
            'transactions'=>$transaction,
            'form'=>$form,
            'affiche_tab_'=>$afficheTab_,
            'du' => $date_du_,
            'au' => $date_au_,
            'one_date' => $date1,
            'date_1' => $date_1,
            'date_2' => $date_2,
            'titre' => $titre,
            'total_montant' => $SommeMontant,
        ]);
    }


    /**
     * Depot solde de tous les produits  epargne
     *
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @param TransactionRepository $transactionRepository
     * @param MouvementEpargne $mouvement
     * @return Response
     */
    #[Route('/depot', name: 'app_transaction_new', methods: ['GET', 'POST'])]
    public function new(ManagerRegistry $doctrine,Request $request, TransactionRepository $transactionRepository,MouvementEpargne $mouvement): Response
    {     
        $id = $request->query->get('code');

        if ($request->query->get('status')) {
            $status = $request->query->get('status');
        }else {
            $status = "";
        }
            /***Information du compte epargne */
        $infoCompte = $transactionRepository->getInfoCompteEpargne($id)[0];
        // dd($infoCompte);
        $soldeCurrent = $transactionRepository->soldeCurrent($infoCompte['code']);

        if($soldeCurrent == null ){
            $soldeCurrent[0]['solde'] = 0;
        }

        $transaction = new Transaction();

        // dd($infoCompte);
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        // dd($transaction);
        if ($form->isSubmitted() && $form->isValid()) {
            //produit epragne utiliseer
            $get_produits_id = $infoCompte['id_produit_epargne'];

            //Verifier les solde de depot s 'il est positive
            if($transaction->getMontant() > 0){

                //Verfier s
                // dd(,$transaction->getMontant());

                $transaction->setCodetransaction(random_int(2,1000000000));
                $transaction->setDescription($transaction->getDescription()." Compte epargne INDIVIDUEL");

                $entityManager=$doctrine->getManager();

                /**Inserer dans la table Mouvement comptable */
                $mouvement->operationJournal($entityManager,$transaction,$get_produits_id);

                //Verifier si le solde n'est pas nombre 
                if ($transaction->getSolde() == "NaN") {
                    $transaction->setSolde($transaction->getMontant());
                }
            
                $entityManager->persist($transaction);
                $entityManager->flush();

                $this->addFlash('info', " Depot de ".$form->get('montant_bruite')->getData()." ".$form->get('devise')->getData()." réussite du compte epargne individuel " .$transaction->getCodeepargneclient().". Le solde de depot est :  ".$transaction->getMontant()."  ".$form->get('devise')->getData().". Réference : ".$transaction->getCodetransaction().". Le nouveau solde total est : ".$transaction->getSolde()." ".$form->get('devise')->getData());
                
            }

            // Sinon on ne peut pas faire le transaction
            else {
                $this->addFlash('danger','Vous avez entré un montant negative.Le montant entré doit etre strictement positive. Veuillez réessayer !!');
            }
            return $this->redirectToRoute('app_transaction_new', [
                'code' => $id
                ,"status" => $status
            ], Response::HTTP_SEE_OTHER);
        }

        // dd($infoCompte);
        return $this->renderForm('Module_epargne/transaction/depot_epargne.html.twig', [
            'transaction' => $transaction,
            'form' => $form,
            'info' => $infoCompte,
            'solde' => $soldeCurrent[0]['solde'],
            'id_produit' => $infoCompte['id_produit_epargne'],
            'status' => $status,
        ]);
    }


    /**
     * Retrait de tous les produits sur compte epargne
     *
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @param TransactionRepository $transactionRepository
     * @param MouvementRetrait $mouvement
     * @return Response
     */
    #[Route('/retrait', name: 'app_retrait', methods: ['GET', 'POST'])]
    public function Retraitindividuel(ManagerRegistry $doctrine,Request $request, TransactionRepository $transactionRepository,MouvementEpargne $mouvement): Response
    {
        $id = $request->query->get('code');
        if ($request->query->get('status')) {
            $status = $request->query->get('status');
        }else {
            $status = "";
        }
        /***Information du compte epargne */
        $infoCompte = $transactionRepository->getInfoCompteEpargne($id)[0];
        // dd($infoCompte);
        $soldeCurrent = $transactionRepository->soldeCurrent($infoCompte['code']);
        
        if($soldeCurrent == null ){
            $soldeCurrent[0]['solde'] = 0;
        }        
        
        $transaction = new Transaction();
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager=$doctrine->getManager();

            $transaction->setDescription($transaction->getDescription()." Compte epargne");
            $transaction->setMontant(-$transaction->getMontant());
            $transaction->setCodetransaction(random_int(1,2000000));

            
            //Recuperer le produit epragne utiliseer
            $get_produits_id = $infoCompte['id_produit_epargne'];

            /**Inserer dans la table Mouvement comptable */
            $mouvement->operationJournal($entityManager,$transaction,$get_produits_id);

            $entityManager->persist($transaction);
            $entityManager->flush();

            $this->addFlash('success', " Rétrait de ".abs($transaction->getMontant())." ".$form->get('devise')->getData()." réussite du compte epargne individuel " .$transaction->getCodeepargneclient()." . Réference : ".$transaction->getCodetransaction().". Le nouveau solde est : ".$transaction->getSolde()." ".$form->get('devise')->getData());
            return $this->redirectToRoute('app_retrait', ['code' => $id,"status" => $status ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_epargne/transaction/retrait_epargne.html.twig', [
            'transaction' => $transaction,
            'form' => $form,
            'info' => $infoCompte,
            'solde' => $soldeCurrent[0]['solde'],
            'status' => $status,
            'id_produit' => $infoCompte['id_produit_epargne'],
        ]);
    }

    
    #[Route('/{id}', name: 'app_transaction_show', methods: ['GET'])]
    public function show(Transaction $transaction): Response
    {
        return $this->render('Module_epargne/transaction/show.html.twig', [
            'transaction' => $transaction,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_transaction_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Transaction $transaction, TransactionRepository $transactionRepository): Response
    {
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transactionRepository->add($transaction, true);

            return $this->redirectToRoute('app_transaction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_epargne/transaction/edit.html.twig', [
            'transaction' => $transaction,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_transaction_delete', methods: ['POST'])]
    public function delete(Request $request, Transaction $transaction, TransactionRepository $transactionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transaction->getId(), $request->request->get('_token'))) {
            $transactionRepository->remove($transaction, true);
        }

        return $this->redirectToRoute('app_transaction_index', [], Response::HTTP_SEE_OTHER);
    }

}
