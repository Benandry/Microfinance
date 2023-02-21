<?php

namespace App\Controller\Comptabilite\TraitementCompta;


use App\Entity\MouvementComptable;
use App\Repository\TransactionRepository;

class MouvementEpargne
{
    private $repo;
    public function __construct(TransactionRepository $transactionRepository)
    {
         /**Configuration du produit epargne */
         $this->repo = $transactionRepository;
    }

    /***Journale */
    public function operationJournal($em,$transaction,$produits_id ) : void
    {
        /** -- Debit */
        $debit = $this->repo->findConfigEpDepotDebit($produits_id)[0];
        $credit = $this->repo->findConfigEpDepotCredit($produits_id)[0];
        $compta = new MouvementComptable();
        $compta->setCodeclient($transaction->getCodeepargneclient());
        $compta->setDateMouvement($transaction->getDateTransaction());
        $compta->setDescription($transaction->getDescription());
        $compta->setDebit($transaction->getMontant());
        $compta->setSolde($transaction->getMontant());
        $compta->setRefTransaction($transaction->getCodetransaction());
        $compta->setPieceComptable($transaction->getPieceComptable());

        $compta->setPlanCompta($debit);

        $em->persist($compta);
        // $em->flush();

        
    /**Credit */ 

        $compta = new MouvementComptable();
        $compta->setDateMouvement($transaction->getDateTransaction());
        $compta->setDescription($transaction->getDescription());
        $compta->setCodeclient($transaction->getCodeepargneclient());
        $compta->setCredit($transaction->getMontant());
        $compta->setSolde($transaction->getMontant());
        $compta->setRefTransaction($transaction->getCodetransaction());
        $compta->setPieceComptable($transaction->getPieceComptable());

        $compta->setPlanCompta($credit);

        $em->persist($compta);
        $em->flush();
    }
}