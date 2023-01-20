<?php

namespace App\Controller\Module_epargne;

use App\Controller\Comptabilite\TraitementCompta\MouvementEpargne;
use App\Controller\Comptabilite\TraitementCompta\MouvementRetrait;
use App\Entity\Transaction;
use App\Form\FiltreRapportTransactionType;
use App\Form\RapportTransactionDuJourType;
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

    #[Route('/', name: 'app_transaction_index')]
    public function index(Request $request,AgenceRepository $agenceRepository,TransactionRepository $transactionRepository): Response
    {
        $transaction=$transactionRepository->RapportTransaction();
        // dd($transaction);
        #--------------Date afficher ---------------------------#
        $date_1 = false;
        $date_2 = false;
        $date_du_ = 0;
        $date_au_ = 0;
        $date1 = 0;

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
            
            if ($date1 != null) {
                // En une date ///////////
                $date_1 = true;
                $transaction=$transactionRepository->FiltreDateArreteTransac($date1);
            }else{
                // Entre deux dates ///////////
                $date_2 = true;
                $transaction=$transactionRepository->FiltreRapportSolde($date_du_,$date_au_);
                
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
        ]);
    }


    // Nouveau depot
    #[Route('/new', name: 'app_transaction_new', methods: ['GET', 'POST'])]
    public function new(ManagerRegistry $doctrine,Request $request, TransactionRepository $transactionRepository,MouvementEpargne $mouvement): Response
    {
        $transaction = new Transaction();
        
        $code = $request->query->get('code');
        $code_client = $request->query->get('cod_client');
        $nom = $request->query->get('nom');
        $prenom = $request->query->get('prenom');
        $email = $request->query->get('email');
        $code_groupe = $request->query->get('code_groupe');

        //dd($code_groupe);
        $soldeCurrent = $transactionRepository->soldeCurrent($code);

        if($soldeCurrent == null ){
            $soldeCurrent[0]['solde'] = 0;
        }

       //dd($soldeCurrent);
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $refTransac = random_int(2,1000000000);
            $transaction->setCodetransaction($refTransac);
            $entityManager=$doctrine->getManager();

            /**Inserer dans la table Mouvement comptable */
            $mouvement->operationJournal($entityManager,$transaction);

            $Description=$transaction->getDescription();
            $transaction->setDescription($Description);

            $PieceComptable=$transaction->getPieceComptable();
            $transaction->setPieceComptable($PieceComptable);

            $DateTransaction=$transaction->getDateTransaction();
            $transaction->setDateTransaction($DateTransaction);

            $Montant=$transaction->getMontant();
            $transaction->setMontant($Montant);

            $Papeterie=$transaction->getPapeterie();
            $transaction->setPapeterie($Papeterie);

            $Commission=$transaction->getCommission();
            $transaction->setCommission($Commission);

            $TypeClient=$transaction->getTypeClient();
            $transaction->setTypeClient($TypeClient);

            $solde=$transaction->getSolde();

            if ($solde == "NaN") {
                $transaction->setSolde($Montant);
            }else{
                $transaction->setSolde($solde);
            }
            

            $entityManager->persist($transaction);
            $entityManager->flush();

            $this->addFlash('success', " Transaction depot compte epargne '" .$transaction->getCodeepargneclient()."'réussite!!!");
            return $this->redirectToRoute('app_transaction_new', [
                'code' => $code,
                'cod_client' => $code_client,
                'code' => $code,
                'nom' => $nom,
                'prenom' => $prenom,
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_epargne/transaction/new.html.twig', [
            'transaction' => $transaction,
            'form' => $form,
            'code' => $code,
            'code_client' => $code_client,
            'nom' => $nom,
            'prenom' => $prenom,
            'solde' => $soldeCurrent[0]['solde'],
        ]);
    }
    
    // Retrait
    #[Route('/retrait', name: 'app_transaction_retrait', methods: ['GET', 'POST'])]
    public function Retraitgroupe(ManagerRegistry $doctrine,Request $request, TransactionRepository $transactionRepository,MouvementRetrait $mouvement): Response
    {
        $transaction = new Transaction();

        $code = $request->query->get('code');
        $nom = $request->query->get('nom');

        // dd($code,$nom);

        $soldeCurrent = $transactionRepository->soldeCurrent($code);

        if($soldeCurrent == null ){
            $soldeCurrent[0]['solde'] = 0;
        }        


        $form = $this->createForm(TransactionretraitType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager=$doctrine->getManager();

            $mouvement->operationJournal($entityManager,$transaction);

            $transaction->setCodetransaction(random_int(1,2000000));

            $codeclient=$transaction->getCodeepargneclient();
            $transaction->setCodeepargneclient($codeclient);

            $Description=$transaction->getDescription();
            $transaction->setDescription($Description);

            $PieceComptable=$transaction->getPieceComptable();
            $transaction->setPieceComptable($PieceComptable);

            $DateTransaction=$transaction->getDateTransaction();
            $transaction->setDateTransaction($DateTransaction);

            $Montant=$transaction->getMontant();
            $transaction->setMontant(-$Montant);

            $Papeterie=$transaction->getPapeterie();
            $transaction->setPapeterie($Papeterie);

            $Commission=$transaction->getCommission();
            $transaction->setCommission($Commission);

            $TypeClient=$transaction->getTypeClient();
            $transaction->setTypeClient($TypeClient);

            $solde=$transaction->getSolde();
            $transaction->setSolde($solde);

            $entityManager->persist($transaction);
            $entityManager->flush();
            $this->addFlash('success', "Transaction retrait compte epargne '" .$transaction->getCodeepargneclient()."' réussite!!!");
           return $this->redirectToRoute('app_transaction_retrait', [
            'nom' => $nom,
            'code' => $code
           ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_epargne/transaction/retrait.html.twig', [
            'transaction' => $transaction,
            'form' => $form,
            'code'=>$code,
            'nom'=>$nom,
            'solde' => $soldeCurrent[0]['solde']
        ]);
    }

    // Retrait individuel
        // Retrait
        #[Route('/individuel', name: 'app_retrait', methods: ['GET', 'POST'])]
        public function Retraitindividuel(ManagerRegistry $doctrine,Request $request, TransactionRepository $transactionRepository,MouvementRetrait $mouvement): Response
        {
            $transaction = new Transaction();
    
            $code = $request->query->get('code');
            $codeclient=$request->query->get('cod_client');
            $nom = $request->query->get('nom');
            $prenom=$request->query->get('prenom');
    
            // dd($code,$nom,$prenom,$codeclient);
    
            $soldeCurrent = $transactionRepository->soldeCurrent($code);
    
            if($soldeCurrent == null ){
                $soldeCurrent[0]['solde'] = 0;
            }        

            $form = $this->createForm(TransactionretraitType::class, $transaction);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager=$doctrine->getManager();

                $mouvement->operationJournal($entityManager,$transaction);
    
                $transaction->setCodetransaction(random_int(1,2000000));
    
                $codeclient=$transaction->getCodeepargneclient();
                $transaction->setCodeepargneclient($codeclient);
    
                $Description=$transaction->getDescription();
                $transaction->setDescription($Description);
    
                $PieceComptable=$transaction->getPieceComptable();
                $transaction->setPieceComptable($PieceComptable);
    
                $DateTransaction=$transaction->getDateTransaction();
                $transaction->setDateTransaction($DateTransaction);
    
                $Montant=$transaction->getMontant();
                $transaction->setMontant(-$Montant);
    
                $Papeterie=$transaction->getPapeterie();
                $transaction->setPapeterie($Papeterie);
    
                $Commission=$transaction->getCommission();
                $transaction->setCommission($Commission);
    
                $TypeClient=$transaction->getTypeClient();
                $transaction->setTypeClient($TypeClient);
    
                $solde=$transaction->getSolde();
                $transaction->setSolde($solde);
    
                $entityManager->persist($transaction);
                $entityManager->flush();
                $this->addFlash('success', "Transaction retrait compte epargne '" .$transaction->getCodeepargneclient()."' réussite!!!");
                return $this->redirectToRoute('app_retrait', [
                    'code' => $code,
                    'cod_client' => $codeclient,
                    'code' => $code,
                    'nom' => $nom,
                    'prenom' => $prenom,
                ], Response::HTTP_SEE_OTHER);
            }
    
            return $this->renderForm('Module_epargne/transaction/retrait_individuel_form.html.twig', [
                'transaction' => $transaction,
                'form' => $form,
                'code'=>$code,
                'nom'=>$nom,
                'prenom'=>$prenom,
                'solde' => $soldeCurrent[0]['solde']
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
