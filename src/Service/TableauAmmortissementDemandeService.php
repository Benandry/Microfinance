<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;

class TableauAmmortissementDemandeService
{
    /**
     * Undocumented function
     *@method mixed Lineaire()
     * @param [type] $data
     * @return void
     */
    public function Lineaire($data)
    {

        // $DateDemande = date('Y/m/d');
        // $DateDemande = date("Y-m-d", strtotime($DateDemande.'+ 1 month'));
        /**
         * Recuperation des donnees venant de la base de donnees DemandeCredit.php 
         */
        $DateDemande = date('Y/m/d');
        $DateDemande = date("Y-m-d", strtotime($DateDemande.'+ 1 month'));
        $codeclient=$data->getCodeclient();
        $TypeClient=$data->getTypeClient();
        $NumeroCredit=$data->getNumeroCredit();
        $DateDemande=$data->getDateDemande();
        $MontantDemande=$data->getMontant();
        $InteretAnnuel=$MontantDemande*($data->getTauxInteretAnnuel()/100);
        $Periode=$data->getNombreTranche();
        $TypeTranche=$data->getTypeTranche();

        /**
         * Creation de la tableau d'ammortissement
         */


        // Calcul capital
        $Capital=$MontantDemande/$Periode;
        // Calcum Interet
        $Interet=$InteretAnnuel/$Periode;
        // Total credit
        $Credit=$Capital+$Interet;
        // Echeance
        $Echeance=$Credit/$Periode;
        // Capital restant du
        $CapitalRD=$MontantDemande-$Capital;
        // Interet Restant du
        $IRD=$InteretAnnuel-$Interet;
        // Credit restant du
        $CRD=$Credit-$Echeance;

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

        // dd($tableau);
        //     return  $this->redirectToRoute('app_lineaire',[
    //         'Periode'=>$Periode,
    //         'codeclient'=>$codeclient,
    //         'TypeClient'=>$TypeClient,
    //         'NumeroCredit'=>$NumeroCredit,
    //         'DateDemande'=>$DateDemande,
    //         'Capital'=>$Capital,
    //         'Interet'=>$Interet,
    //         'Echeance'=>$Echeance,
    //         'CapitalRD'=>$CapitalRD,
    //         'IRD'=>$IRD,
    //         'CRD'=>$CRD,
    //         'TypeTranche'=>$TypeTranche
    //     ],Response::HTTP_SEE_OTHER
    // );   
 }
}