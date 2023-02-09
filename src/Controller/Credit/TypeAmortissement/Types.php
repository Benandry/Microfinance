<?php

namespace App\Controller\Credit\TypeAmortissement;;

use App\Entity\AmortissementFixe;
use Doctrine\Persistence\ManagerRegistry;

class Types
{

    private $doctine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctine = $doctrine;
    }

    /**Amortissement simple */
    public function amortissementSimple($data)
    {

        /**Code credit */
        $codeclient = $data->getCodeclient();
        $codecredit = $data->getNumeroCredit();
        $tranche = $data->getNombreTranche();

        $dateRemb = date('Y/m/d');
        $dateRemb = date("Y-m-d", strtotime($dateRemb.'+ 1 month'));
        $capitalDu = $data->getMontant() / $tranche;
        $interetTotal = $data->getMontant() * ($data->getTauxInteretAnnuel()/100);
        $interet = $interetTotal / $tranche;
        $netPayer = $capitalDu + $interet;
<<<<<<< HEAD

        $tableau_amort = [ 
=======
        $soldedu=$netPayer;

        $tableau_amort = [
>>>>>>> refs/remotes/origin/main
            [
                'periode' => 1, 
                'dateRemb' => $dateRemb,
                'CapitalDu' =>$capitalDu,
                "interet" => $interet,
                "montantPayer" =>$netPayer,
<<<<<<< HEAD
            ],  
        ];

        /******************************Amortissement simple ******************* */
        for ( $i = 1 ; $i < $tranche; $i++ ) {
            $dateRemb =  date("Y-m-d", strtotime($dateRemb.'+ 1 month'));
            array_push($tableau_amort,[
=======
                "soldedu"=>$soldedu,
            ],  
        ];

        // dd($tableau_amort);
        /******************************Amortissement simple ******************* */
        for ( $i = 1 ; $i < $tranche; $i++ ) {
            $dateRemb =  date("Y-m-d", strtotime($dateRemb.'+ 1 month'));
            /**
             * S
             */

            $soldedu+=$netPayer;

           array_push($tableau_amort,[
>>>>>>> refs/remotes/origin/main
                'periode'=> $i+1,
                'dateRemb'=>$dateRemb,
                'CapitalDu'=>$capitalDu,
                'interet'=>$interet,
                'montantPayer'=>$netPayer,
<<<<<<< HEAD
            ]);
        }

=======
                "soldedu"=>$soldedu,
            ]);

        }

        // dd($tableau_amort);

>>>>>>> refs/remotes/origin/main
        /***Insertion dans la base de donner */
                        
        $entityManager = $this->doctine->getManager();
        for ($i=0; $i < $tranche; $i++) { 
            $amortissement = new AmortissementFixe();
            $amortissement->setDateRemborsement(date_create($tableau_amort[$i]['dateRemb']));
            $amortissement->setPrincipale($tableau_amort[$i]['CapitalDu']);
            $amortissement->setInteret($tableau_amort[$i]['interet']);
            $amortissement->setMontanttTotal($tableau_amort[$i]['montantPayer']);
            $amortissement->setPeriode($tableau_amort[$i]['periode']);
            $amortissement->setCodeclient($codeclient);
            $amortissement->setCodecredit($codecredit);
            $amortissement->setTypeamortissement('simple');
<<<<<<< HEAD
=======
            $amortissement->setSoldedu($tableau_amort[$i]['soldedu']);
>>>>>>> refs/remotes/origin/main
            
            $entityManager->persist($amortissement);
            $entityManager->flush();

        }  
    }

    /***Amortissement par annuites constant */

    public function annuiteConstante($data)
    {
        $codeclient = $data->getCodeclient();
        $codecredit = $data->getNumeroCredit();
        $tauxInteret  = $data->getTauxInteretAnnuel() / 100;
        $tranche = $data->getNombreTranche();
        $capitalRestantDu = $data->getMontant();
        $annuite_constante = $data->getMontant() *( $tauxInteret /(1-pow((1 + $tauxInteret),(-$tranche))));

        $dateRemb = date('Y/m/d');
        $dateRemb = date("Y-m-d", strtotime($dateRemb.'+ 1 month'));
        $interet = $capitalRestantDu * $tauxInteret;
        $amortissement = $annuite_constante - $interet;
<<<<<<< HEAD
=======
        $soldedu=$annuite_constante;
>>>>>>> refs/remotes/origin/main

        $tableau_amortissement = [ 
            [
                'periode' => 1,
                'dateRemb'=> $dateRemb,
                'capitalRestantDu' => $capitalRestantDu, 
                "interet" => $interet,
                'remboursement' => $amortissement,
                'annuite' => $annuite_constante,
<<<<<<< HEAD
=======
                'soldedu'=>$soldedu
>>>>>>> refs/remotes/origin/main
            ], 
        ];

        /**Insertion jusqu a ce que le periode est fini */
        for ( $i = 1; $i < $tranche ; $i++ ) {
            //capital restant du
            $capitalRestantDu = $capitalRestantDu - $amortissement;
            //interet pour les restant
            $interet = $capitalRestantDu * $tauxInteret;
            //amortissement restant
            $amortissement = $annuite_constante - $interet;
            $dateRemb = date("Y-m-d", strtotime($dateRemb.'+ 1 month'));
<<<<<<< HEAD
=======
            // Solde du
            $soldedu+=$annuite_constante;
>>>>>>> refs/remotes/origin/main
            array_push($tableau_amortissement,[
                'periode'=> $i+1,
                'dateRemb' => $dateRemb ,
                'capitalRestantDu' => $capitalRestantDu,
                "interet" => $interet,
                'remboursement' => $amortissement,
                'annuite' => $annuite_constante,
<<<<<<< HEAD
=======
                'soldedu'=>$soldedu
>>>>>>> refs/remotes/origin/main
            ]);
        }

        $entityManager = $this->doctine->getManager();
        for ($i=0; $i < $tranche; $i++) { 
            $amortissement = new AmortissementFixe();
            $amortissement->setDateRemborsement(date_create($tableau_amortissement[$i]['dateRemb']));
            $amortissement->setPrincipale($tableau_amortissement[$i]['capitalRestantDu']);
            $amortissement->setInteret($tableau_amortissement[$i]['interet']);
            $amortissement->setRemboursement($tableau_amortissement[$i]['remboursement']);
            $amortissement->setAnnuite($tableau_amortissement[$i]['annuite']);
            $amortissement->setPeriode($tableau_amortissement[$i]['periode']);
            $amortissement->setCodeclient($codeclient);
            $amortissement->setCodecredit($codecredit);
            $amortissement->setTypeamortissement('anuuite constante');
<<<<<<< HEAD
=======
            $amortissement->setSoldedu($tableau_amortissement[$i]['soldedu']);
>>>>>>> refs/remotes/origin/main
            
            $entityManager->persist($amortissement);
            $entityManager->flush();
        }
    }

    public function amortissementConstant($data)
    {

        #code 
        $codeclient = $data->getCodeclient();
        $codecredit = $data->getNumeroCredit();
        
        /** Formule amortissement constante est A = capital/periode */
        $tranche = $data->getNombreTranche();
        $taux = $data->getTauxInteretAnnuel() / 100;
        $montant = $data->getMontant();
        $amortissement_constante = $montant/ $tranche ;
        $interet = $montant *$taux;
        $annuite = $amortissement_constante + $interet;
<<<<<<< HEAD
=======
        $soldedu=$annuite;
>>>>>>> refs/remotes/origin/main

        
        $dateRemb = date('Y/m/d');
        $dateRemb = date("Y-m-d", strtotime($dateRemb.'+ 1 month'));
        $tableau_amortissement = [
            [
                'periode' => 1,
                'dateRemboursement' => $dateRemb,
                'capitalRestantDu' => $montant,
                'interet' => $interet,
                'remboursement' => $amortissement_constante,
                'annuite' => $annuite,
<<<<<<< HEAD
=======
                'soldedu' => $soldedu,
>>>>>>> refs/remotes/origin/main
            ]
        ];

           // * Etablissement du tableau d’amortissement
              
        for ($i=1; $i < $tranche; $i++) { 
            $montant = $montant - $amortissement_constante;
            $interet = $montant * $taux;
            $annuite = $amortissement_constante + $interet;
            $dateRemb = date("Y-m-d", strtotime($dateRemb.'+ 1 month'));
<<<<<<< HEAD
=======

            // Solde du
            $soldedu+=$annuite;
>>>>>>> refs/remotes/origin/main
            array_push($tableau_amortissement,[
                'periode' => $i+1,
                'dateRemboursement' => $dateRemb,
                'capitalRestantDu' => $montant,
                'interet' => $interet,
                'remboursement' => $amortissement_constante,
                'annuite' => $annuite,
<<<<<<< HEAD
=======
                'soldedu' => $soldedu
>>>>>>> refs/remotes/origin/main
            ]);
        }

        $entityManager = $this->doctine->getManager();
        for ($i=0; $i < count($tableau_amortissement); $i++) { 
            $amortissement = new AmortissementFixe();
            $amortissement->setDateRemborsement(date_create($tableau_amortissement[$i]['dateRemboursement']));
            $amortissement->setPrincipale($tableau_amortissement[$i]['capitalRestantDu']);
            $amortissement->setInteret($tableau_amortissement[$i]['interet']);
            $amortissement->setRemboursement($tableau_amortissement[$i]['remboursement']);
            $amortissement->setAnnuite($tableau_amortissement[$i]['annuite']);
            $amortissement->setPeriode($tableau_amortissement[$i]['periode']);
            $amortissement->setCodeclient($codeclient);
            $amortissement->setCodecredit($codecredit);
            $amortissement->setTypeamortissement("amortissement constante");
<<<<<<< HEAD
=======
            $amortissement->setSoldedu($tableau_amortissement[$i]['soldedu']);
>>>>>>> refs/remotes/origin/main
            
            $entityManager->persist($amortissement);
            $entityManager->flush();
        }
    }
}