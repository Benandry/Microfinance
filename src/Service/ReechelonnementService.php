<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;

class ReechelonnementService
{
    /**
     * Undocumented function
     *@method mixed Lineaire()
     * @param [type] $data
     * @return void
     */
    public function Reechelonner($ResteCredit,$ResteCapital,$ResteInteret,$PeriodeDu,$DateDemande)
    {
        $Periode=$PeriodeDu;
        // Echeance
        $Echeance=$ResteCredit/$PeriodeDu;
        // Capital
        $Capital=$ResteCapital/$PeriodeDu;
        // Interet
        $Interet=$ResteInteret/$PeriodeDu;

        // Interet  restant du
        $IRD=$ResteInteret-$Interet;

        // Capital restant du
        $CapitalRD=$ResteCapital-$Capital;

        // Credit restant du
        $CRD=$ResteCredit-$Echeance;


        // Stocker dans une tableau les donnees
        $tableau=[[

            'Periode'=>1,
            'DateDemande'=>$DateDemande,
            'Capital'=>$Capital,
            'Interet'=>$Interet,
            'Echeance'=>$Echeance,
            'CapitalRD'=>$CapitalRD,
            'IRD'=>$IRD,
            'CRD'=>$CRD,
            ]
        ];
        
        // Creation du tableau d'ammortissement
        for($i=1;$i < $Periode;$i++)
        {
            // Date demande +1
            $DateDemande = date('Y/m/d');
            $DateDemande= date("Y-m-d", strtotime($DateDemande.'+ 1 month'));
            $CapitalRD-=$Capital;
            $IRD-=$Interet;
            $CRD-=$Echeance;

            array_push($tableau,[
                'Periode'=>$Periode+1,
                'DateDemande'=>$DateDemande,
                'Capital'=>$Capital,
                'Interet'=>$Interet,
                'Echeance'=>$Echeance,
                'CapitalRD'=>$CapitalRD,
                'IRD'=>$IRD,
                'CRD'=>$CRD,
                ]
            );
        }
 }
}