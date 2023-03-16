<?php

namespace App\Controller\Credit;

use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Credit\TypeAmortissement\Types;
use App\Entity\DemandeCredit;
use App\Repository\DemandeCreditRepository;
use App\Service\TableauAmmortissementDemandeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AffichageAmmortissementController extends AbstractController
{   
    #[Route('/Lin/Amm/{codecredit}',name:'app_lineaire', methods: ['GET', 'POST'])]
    public function AmmortissementLineaire(Request $request,$codecredit,DemandeCreditRepository $demandeCreditRepository,TableauAmmortissementDemandeService $amortissement):Response
    {
        // $codecredit=$request->query->get('codecredit');
        // $tableau=$amortissement->Lineaire($data);

        // dd($tableau);

        $demandeAmmortissement=$demandeCreditRepository->Ammortissement($codecredit);
        dd($demandeAmmortissement);

        // $codecredit=$request->query->get('codecredit');
        // dd($codecredit);
        // $Montant=$data->getMontant();
        // $TauxInteretAnnuel=$data->getTauxInteretAnnuel();
        // $NumeroCreditDemande=$data->getNumeroCredit();
        // $NombreTranche=$data->getNombreTranche();

        // $codecredit=$request->query->get('NumeroCredit');
        // $Periode=$request->query->get('Periode');
        // $codeclient=$request->query->get('codeclient');
        // $TypeClient=$request->query->get('TypeClient');
        // $DateDemande=$request->query->get('DateDemande');
        // $Capital=$request->query->get('Capital');
        // $Interet=$request->query->get('Interet');
        // $Echeance=$request->query->get('Echeance');
        // $CapitalRD=$request->query->get('CapitalRD');
        // $IRD=$request->query->get('IRD');
        // $CRD=$request->query->get('CRD');

        // $AmmotissementLineaire=$demandeCreditRepository->Ammortissement($codecredit);

    //     return $this->render('demande_credit/amortissement/index.html.twig'
    //     ,[
    //         // 'NumeroCredit'=>$codecredit,
    //         // 'Periode'=>$Periode,
    //         // 'codeclient'=>$codeclient,
    //         // 'TypeClient'=>$TypeClient,
    //         // 'DateDemande'=>$DateDemande,
    //         // 'Capital'=>$Capital,
    //         // 'Interet'=>$Interet,
    //         // 'Echeance'=>$Echeance,
    //         // 'CapitalRD'=>$CapitalRD,
    //         // 'IRD'=>$IRD,
    //         // 'CRD'=>$CRD,
    //         'demandeAmmortissement'=>$demandeAmmortissement,
    //     ]
    // );

    }
}