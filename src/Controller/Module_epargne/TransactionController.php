<?php

namespace App\Controller\Module_epargne;

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
                $transaction=$transactionRepository->FiltreDateArreteTransac($date1);
            }else{
                // Entre deux dates ///////////
                $transaction=$transactionRepository->FiltreRapportSolde($date_du_,$date_au_);
                
            }
        }


        return $this->renderForm('Module_epargne/transaction/DernierTransaction.html.twig', [
            'agences' => $agenceRepository->findAll(),
            'transactions'=>$transaction,
            'form'=>$form,
            'affiche_tab_'=>$afficheTab_,
        ]);
    }


    // Nouveau depot
    #[Route('/new', name: 'app_transaction_new', methods: ['GET', 'POST'])]
    public function new(ManagerRegistry $doctrine,Request $request, TransactionRepository $transactionRepository): Response
    {
        $transaction = new Transaction();
        $code = $request->query->get('code');
        $code_client = $request->query->get('cod_client');
        $nom = $request->query->get('nom');
        $prenom = $request->query->get('prenom');

        #dd($code);
        $soldeCurrent = $transactionRepository->soldeCurrent($code);
        #dd($soldeCurrent);

        if($soldeCurrent == null ){
            $soldeCurrent[0]['solde'] = 0;
        }

       //dd($soldeCurrent);
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // $transactionRepository->add($transaction,true);

            $entityManager=$doctrine->getManager();

            $transaction->setCodetransaction(random_int(2,1000000000));

            $codeclient=$transaction->getCodeepargneclient();
            $transaction->setCodeepargneclient($codeclient);

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
    public function Retrait(ManagerRegistry $doctrine,Request $request, TransactionRepository $transactionRepository): Response
    {
        $transaction = new Transaction();
        $form = $this->createForm(TransactionretraitType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $transactionRepository->add($transaction, true);

            $entityManager=$doctrine->getManager();

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
           // return $this->redirectToRoute('app_transaction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_epargne/transaction/retrait.html.twig', [
            'transaction' => $transaction,
            'form' => $form,
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
