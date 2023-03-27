<?php

namespace App\Controller\Credit;

use App\Form\PasseEnPerteModalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PasseEnPerteModalController extends AbstractController
{
    #[Route('/Passe/En/Perte/',name:'app_passe_en_perte')]
    public function PasseEnPerte(Request $request)
    {
        $form=$this->createForm(PasseEnPerteModalType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {   
            $data=$form->getData();

            $NumeroCredit=$data['NumeroCredit'];
            $CodeCredit=$data['CodeCredit'];
            $CodeClient=$data['CodeClient'];
            $NomClient=$data['NomClient'];
            $PrenomClient=$data['PrenomClient'];

            return $this->redirectToRoute('app_credit_perte',[
                'NumeroCredit'=>$NumeroCredit,
                'CodeCredit'=>$CodeCredit,
                'CodeClient'=>$CodeClient,
                'NomClient'=>$NomClient,
                'PrenomClient'=>$PrenomClient,
            ]);

        }
        return $this->renderForm('Module_credit/Perte/ModalPerte.html.twig',[
                'form'=>$form
            ]); 
    }
}