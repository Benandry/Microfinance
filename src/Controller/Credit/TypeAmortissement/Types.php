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
        $CRD=$data->getMontant()-$capitalDu;
        $MRD=($data->getMontant()+$interetTotal)-$netPayer;

        $tableau_amort = [
            [
                'periode' => 1, 
                'dateRemb' => $dateRemb,
                'CapitalDu' =>$capitalDu,
                "interet" => $interet,
                "montantPayer" =>$netPayer,
                "soldedu"=>$CRD,
                "MontantRestantDu"=>$MRD
            ],
        ];

        // dd($tableau_amort);
        /******************************Amortissement simple ******************* */
        for ( $i = 1 ; $i < $tranche; $i++ ) {
            $dateRemb =  date("Y-m-d", strtotime($dateRemb.'+ 1 month'));
            /**
             * S
             */

            $CRD-=$capitalDu;
            $MRD-=$netPayer;

           array_push($tableau_amort,[
                'periode'=> $i+1,
                'dateRemb'=>$dateRemb,
                'CapitalDu'=>$capitalDu,
                'interet'=>$interet,
                'montantPayer'=>$netPayer,
                "soldedu"=>$CRD,
                "MontantRestantDu"=>$MRD
            ]);

        }

        // dd($tableau_amort);

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
            $amortissement->setSoldedu($tableau_amort[$i]['soldedu']);
            $amortissement->setMontantRestantDu($tableau_amort[$i]['MontantRestantDu']);
            
            $entityManager->persist($amortissement);
            $entityManager->flush();

        }  
    }

    /**
     * Undocumented function
     *@method mixed Degressif()
     * @param [type] $data
     * @return void
     */
     public function Degressif($data)
     {
 
         /**Code credit */
         $codeclient = $data->getCodeclient();
         $codecredit = $data->getNumeroCredit();
         $tranche = $data->getNombreTranche();
 
         $dateRemb = date('Y/m/d');
         $dateRemb = date("Y-m-d", strtotime($dateRemb.'+ 1 month'));
         $capitalDu = $data->getMontant() / $tranche;
         $interetTotal = $data->getTauxInteretAnnuel();
         $interetDu = $interetTotal / $tranche;
         $CRD=$data->getMontant()-$capitalDu;
         
         $interet=$CRD*$interetDu/100;
         $MontantPayer=$capitalDu+$interet;
         

         $tableau_amort = [
             [
                 'periode' => 1, 
                 'dateRemb' => $dateRemb,
                 'CapitalDu' =>$capitalDu,
                 "interet" => $interet,
                 "montantPayer" =>$MontantPayer,
                 "soldedu"=>$CRD,
             ],
         ];
 
         // dd($tableau_amort);
         /******************************Amortissement simple ******************* */
         for ( $i = 1 ; $i < $tranche; $i++ ) {
             $dateRemb =  date("Y-m-d", strtotime($dateRemb.'+ 1 month'));
             /**
              * S
              */
 
             $CRD-=$capitalDu;
             $interet=$CRD*$interetDu/100;
             $MontantPayer=$capitalDu+$interet;
             $MRD=($CRD+$interet)-$MontantPayer;
 
            array_push($tableau_amort,[
                 'periode'=> $i+1,
                 'dateRemb'=>$dateRemb,
                 'CapitalDu'=>$capitalDu,
                 'interet'=>$interet,
                 'montantPayer'=>$MontantPayer,
                 "soldedu"=>$CRD,
             ]);
 
         }
 
        //  dd($tableau_amort);
 
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
             $amortissement->setSoldedu($tableau_amort[$i]['soldedu']);
             
             $entityManager->persist($amortissement);
             $entityManager->flush();
 
         }  
     }
}