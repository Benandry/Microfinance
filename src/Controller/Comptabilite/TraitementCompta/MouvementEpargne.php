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

        $montant = $transaction->getMontant();
        //Compte de caisse dans le plan comptable selon leur compte caisse ce qu'on a entre precedament
        $caisse = $transaction->getCompteCaisse()->getPlanComptable();
        // Plan comptable selon choisi dans le  configuration 
        $produit = $this->repo->findCompteProduit($produits_id)[0];
        // dd($produit);
        $compta = new MouvementComptable();
        $compta->setCodeclient($transaction->getCodeepargneclient());
        $compta->setDateMouvement($transaction->getDateTransaction());
        $compta->setDescription($transaction->getDescription());
        $compta->setDebit($montant);
        $compta->setSolde($montant);
        $compta->setRefTransaction($transaction->getCodetransaction());
        $compta->setPieceComptable($transaction->getPieceComptable());

        // Si le montant est positive on va debiter le caisse sur compte epargne Sinon debiter le produit
        if ($montant > 0) {
            $compta->setPlanCompta($caisse);
        }else {
            $compta->setPlanCompta($produit);
        }
        $em->persist($compta);
        
        /**Credit */         
        $compta = new MouvementComptable();
        $compta->setDateMouvement($transaction->getDateTransaction());
        $compta->setDescription($transaction->getDescription());
        $compta->setCodeclient($transaction->getCodeepargneclient());
        $compta->setCredit($montant);
        $compta->setSolde($montant);
        $compta->setRefTransaction($transaction->getCodetransaction());
        $compta->setPieceComptable($transaction->getPieceComptable());

        
        //Inverse de la condition ci-dessus. Si le montant est negative on va crediter le caisse sur compte epargne Sinon crediter le produit
        if ($montant < 0) {
            $compta->setPlanCompta($caisse);
        }else {
            $compta->setPlanCompta($produit);
        }

        $em->persist($compta);
        $em->flush();
    }
}