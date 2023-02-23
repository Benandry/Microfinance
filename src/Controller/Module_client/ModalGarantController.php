<?php

namespace App\Controller\Module_client;

use App\Form\ModalGarantType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModalGarantController extends AbstractController
{
    #[Route('/Modal/Garant/',name:'app_modal_garant')]
    public function ModalGarant(Request $request):Response
    {

        $form=$this->createForm(ModalGarantType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data=$form->getData();

            $nom=$data['nom'];
            
            return $this->redirectToRoute('app_garant',
            [
                'nom'=>$nom,
            ],Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_client/individuel/Garant.html.twig',[
            'nom'=>'nom',
            'form'=>$form
        ]
            );

    }
}