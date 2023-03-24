<?php

namespace App\Controller\Credit\Decaissement;

use App\Form\DecaissementIndividuelModalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DecaissementIndividuelModalController extends AbstractController
{
    #[Route('/Decaissement/Modal',name:'app_decaissement_modal')]
    public function DecaissementModalIndividuel(Request $request){
        
        $form=$this->createForm(DecaissementIndividuelModalType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // Recuperer les donnees du formulaires
            $Client=$form->get('Client')->getData();
            $Mode=$form->get('Mode')->getData();
            $nomclient=$form->get('nomclient')->getData();
            $prenomclient=$form->get('prenomclient')->getData();
            $numerocredit=$form->get('numerocredit')->getData();
            $montantcredit=$form->get('montantcredit')->getData();
            $Interet=$form->get('Interet')->getData();

            return $this->redirectToRoute('app_crud_decaissement_new_individuel',[

                'Client'=>$Client,
                'nomclient'=>$nomclient,
                'prenomclient'=>$prenomclient,
                'numerocredit'=>$numerocredit,
                'montantcredit'=>$montantcredit,
                'Interet'=>$Interet,
                'Mode'=>$Mode,
            ],Response::HTTP_SEE_OTHER
        );
        }

        return $this->renderForm('Module_credit/decaissement/DecaissementIndividuelModal.html.twig',[
            'form'=>$form,
            ]
    );
    }
}