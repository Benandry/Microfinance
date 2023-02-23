<?php

namespace App\Controller\Module_client;

use App\Form\IndividuelclientType;
use App\Repository\GroupeRepository;
use App\Repository\IndividuelclientRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MembreGroupeController extends AbstractController
{

    #[Route('/membregroupe/ajout/',name:'app_ajoutmembregroupe')]
    public function AjoutMembreGroupe(Request $request,FileUploader $fileUploader,IndividuelclientRepository $groupeRepository):Response
    {   
        $idclient=$request->query->get('nom');
        // dd($idclient);

        $ajoutmembre=$groupeRepository->AjoutMembre($idclient)[0];
        // dd($ajoutmembre);
        $form=$this->createForm(IndividuelclientType::class,$ajoutmembre);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $brochureFile = $form->get('photo')->getData();
            if ($brochureFile) {
                $brochureFileName = $fileUploader->upload($brochureFile);
                $ajoutmembre->setPhoto($brochureFileName);
            }

            $groupeRepository->add($ajoutmembre,true);

            $this->addFlash('success',$ajoutmembre->getNomClient()." ".$ajoutmembre->getPrenomClient()."est bien ajouter dans une groupe");


        }
        return $this->renderForm('Module_client/groupe/AjoutMembre.html.twig',[
            'form'=>$form,    
        ]
    );
    }
}