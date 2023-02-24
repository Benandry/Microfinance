<?php

namespace App\Controller\Module_client;

use App\Form\ModalPatrimoineType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModalPatrimoineController extends AbstractController
{
    #[Route('/Patrimoine/Individuel/',name:'app_patrimoine')]
    public function ModalPatrimoine(Request $request):Response
    {

        $form=$this->createForm(ModalPatrimoineType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data=$form->getData();

            $nom=$data['nom'];
            
            return $this->redirectToRoute('app_individuelpatrimoine',
            [
                'nom'=>$nom,
            ],Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_client/individuel/PatrimoineModal.html.twig',[
            'nom'=>'nom',
            'form'=>$form
        ]
            );

    }
}