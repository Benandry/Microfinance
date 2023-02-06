<?php

namespace App\Controller\Comptabilite\TraitementCompta;

use App\Entity\MouvementComptable;
use App\Repository\PlanComptableRepository;


class ComptaDecaissement
{

    private $plan;
    public function __construct(PlanComptableRepository $plan)
    {
        $this->plan = $plan;    
    }

    public function decaissement($em,$decaissement)
    {
        // Debit de decaissement
        $compta = new MouvementComptable;
        $compta->setCodeclient($decaissement->getNumeroCredit());
        $compta->setDateMouvement($decaissement->getDateDecaissement());
        $compta->setDescription('DECAISSEMENT de credit');
        $compta->setDebit($decaissement->getMontantCredit());
        $compta->setSolde($decaissement->getMontantCredit());
        $compta->setRefTransaction($decaissement->getRefDecaissement());
        $compta->setPieceComptable($decaissement->getPieceComptable());
     
        $compta->setPlanCompta($this->plan->findPlanById(203)[0]);

        $em->persist($compta);

        $compta = new MouvementComptable;
        $compta->setCredit($decaissement->getMontantCredit());
        $compta->setDateMouvement($decaissement->getDateDecaissement());
        $compta->setDescription('DECAISSEMENT de credit');
        $compta->setSolde($decaissement->getMontantCredit());
        $compta->setRefTransaction($decaissement->getRefDecaissement());
        $compta->setPieceComptable($decaissement->getPieceComptable());

       
        $compta->setPlanCompta($this->plan->findPlanById(10)[0]);

        $em->persist($compta);
        $em->flush();
    }
}