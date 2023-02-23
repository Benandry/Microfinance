<?php

namespace App\Controller\Module_client;

use App\Form\ModalMembreGroupeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModalMembreGroupeController extends AbstractController
{
    #[Route('/ajoutmembregroupe/groupe/',name:'app_membregroupe_modal')]
    public function MembreGroupe(Request $request):Response
    {

        $form=$this->createForm(ModalMembreGroupeType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data=$form->getData();

            $nom=$data['nom'];
            
            return $this->redirectToRoute('app_ajoutmembregroupe',
            [
                'nom'=>$nom,
            ],Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_client/groupe/ModalAjoutMembre.html.twig',[
            'nom'=>'nom',
            'form'=>$form
        ]
            );

    }
}