<?php

namespace App\Controller\Credit;

use App\Form\FicheCreditModalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FicheCreditModalController extends  AbstractController
{
    #[Route('/Modal/Fiche',name:'app_modal_fiche')]
    public function FicheCreditModal(Request $request):Response
    {
        $form=$this->createForm(FicheCreditModalType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data= $form->getData();

            $CodeCredit=$data['CodeCredit'];

            return $this->redirectToRoute('app_fiche_credit',[
                'CodeCredit'=>$CodeCredit,
            ]);
        }

        return $this->renderForm('Module_credit/rapportCredit/FicheCreditModal.html.twig',[
            'form'=>$form,
        ]);
    }
}