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

<<<<<<< HEAD
    public function decaissement($em,$decaissement)
    {
        // Debit de decaissement
        $compta = new MouvementComptable;
        $compta->setCodeclient($decaissement->getNumeroCredit());
        $compta->setDateMouvement($decaissement->getDateDecaissement());
        $compta->setDescription('DECAISSEMENT de credit');
=======
    public function decaissement($em,$decaissement,$debit,$credit)
    {
        // Debit de decaissement
        $compta = new MouvementComptable;
        $compta->setDateMouvement($decaissement->getDateDecaissement());
        $compta->setDescription('Decaissement de credit');
>>>>>>> refs/remotes/origin/main
        $compta->setDebit($decaissement->getMontantCredit());
        $compta->setSolde($decaissement->getMontantCredit());
        $compta->setRefTransaction($decaissement->getRefDecaissement());
        $compta->setPieceComptable($decaissement->getPieceComptable());
<<<<<<< HEAD
     
        $compta->setPlanCompta($this->plan->findPlanById(203)[0]);

        $em->persist($compta);
=======
        if ($debit != null ) {
            // dd($debit);
            $compta->setPlanCompta($debit);
        }
        else{
            $compta->setPlanCompta($this->plan->findPlanById(203)[0]);
        }

        $em->persist($compta);
        $em->flush();
>>>>>>> refs/remotes/origin/main

        $compta = new MouvementComptable;
        $compta->setCredit($decaissement->getMontantCredit());
        $compta->setDateMouvement($decaissement->getDateDecaissement());
<<<<<<< HEAD
        $compta->setDescription('DECAISSEMENT de credit');
=======
        $compta->setDescription('Decaissement de credit');
>>>>>>> refs/remotes/origin/main
        $compta->setSolde($decaissement->getMontantCredit());
        $compta->setRefTransaction($decaissement->getRefDecaissement());
        $compta->setPieceComptable($decaissement->getPieceComptable());

<<<<<<< HEAD
       
        $compta->setPlanCompta($this->plan->findPlanById(10)[0]);

        $em->persist($compta);
        $em->flush();
=======
        if ($credit != null ) {
            $compta->setPlanCompta($credit);
        }else{
            $compta->setPlanCompta($this->plan->findPlanById(10)[0]);
        }

        $em->persist($compta);
        $em->flush();

        // dd($compta);
>>>>>>> refs/remotes/origin/main
    }
}