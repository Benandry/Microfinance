<?php

namespace App\Controller\Comptabilite\TraitementCompta;


use App\Entity\MouvementComptable;
use App\Repository\PlanComptableRepository;
use App\Repository\ProduitEpargneRepository;


class MouvementRetrait 
{
    private $plan;
    private $produit;

    public function __construct(PlanComptableRepository $plan,ProduitEpargneRepository $produit)
    {
        $this->plan = $plan;
        $this->produit = $produit;
    }

    public function operationJournal($em, $transaction)
    {
        /***Debit retrait */
        $compta = new MouvementComptable();
        $compta->setDateMouvement($transaction->getDateTransaction());
        $compta->setDescription($transaction->getDescription().' compte epargne ');
        $compta->setCodeclient($transaction->getCodeepargneclient());
        $compta->setDebit($transaction->getMontant());
        $compta->setSolde($transaction->getMontant());
        $compta->setRefTransaction($transaction->getCodetransaction());
        $compta->setPieceComptable($transaction->getPieceComptable()); 

        $produit = $this->produit->findByProduitDepot($transaction->getCodeepargneclient())[0]->getTypeEpargne()->getAbreviation();

        if($produit == "DAV"){
            $compta->setPlanCompta($this->plan->findPlanById(211)[0]);
        }elseif ($produit == "DAT") {
            $compta->setPlanCompta($this->plan->findPlanById(212)[0]);
        }elseif ($produit == "PEP") {
            $compta->setPlanCompta($this->plan->findPlanById(213)[0]);
        }elseif ($produit == "BDC") {
            $compta->setPlanCompta($this->plan->findPlanById(214)[0]);
        }
        elseif ($produit == "DDG") {
            $compta->setPlanCompta($this->plan->findPlanById(215)[0]);
        }
        else{
            $compta->setPlanCompta($this->plan->findPlanById(21)[0]);
        }

        $em->persist($compta);

        /***Credit retrait */
        $compta = new MouvementComptable();
        $compta->setCodeclient($transaction->getCodeepargneclient());
        $compta->setDateMouvement($transaction->getDateTransaction());
        $compta->setDescription($transaction->getDescription().' compte epargne ');
        $compta->setCredit($transaction->getMontant());
        $compta->setSolde($transaction->getMontant());
        $compta->setRefTransaction($transaction->getCodetransaction());
        $compta->setPieceComptable($transaction->getPieceComptable());
        $compta->setPlanCompta($this->plan->findPlanById(100)[0]);
        
        $em->persist($compta);
        $em->flush();
    }
}