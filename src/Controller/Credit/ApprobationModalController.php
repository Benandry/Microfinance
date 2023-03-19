<?php

namespace App\Controller\Credit;

use App\Form\ApprobationModalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApprobationModalController extends AbstractController
{
    #[Route('/Approbation/Modal/',name:'app_modal_approbation')]
    public function Approbation(Request $request)
    {
        $form=$this->createForm(ApprobationModalType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $data=$form->getData();

            // Recuperation des donnees venant du formulaires

            $CodeCredit=$data['CodeCredit'];
            $CodeClient=$data['CodeClient'];
            $NumeroCredit=$data['NumeroCredit'];
            $TauxInteretAnnuel=$data['TauxInteretAnnuel'];
            $Cycle=$data['Cycle'];
            $NombreTranche=$data['NombreTranche'];
            $TypeTranche=$data['TypeTranche'];
            $Montant=$data['Montant'];
            $NomClient=$data['NomClient'];
            $PrenomClient=$data['PrenomClient'];

            return $this->redirectToRoute('app_approbation_credit_new_individuel',[
                'CodeCredit'=>$CodeCredit,
                'CodeClient'=>$CodeClient,
                'Montant'=>$Montant,
                'NumeroCredit'=>$NumeroCredit,
                'TauxInteretAnnuel'=>$TauxInteretAnnuel,
                'Cycle'=>$Cycle,
                'NombreTranche'=>$NombreTranche,
                'TypeTranche'=>$TypeTranche,
                'NomClient'=>$NomClient,
                'PrenomClient'=>$PrenomClient
            ],Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_credit/approbation_credit/ApprobationModal.html.twig',[
            'form'=>$form
        ]);
    }
}