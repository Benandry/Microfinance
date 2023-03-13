<?php

namespace App\Controller\Credit;

use App\Form\DemandeCreditModalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemandeCreditModalController extends AbstractController
{
    #[Route('DemandeCredit/Modal/',name:'app_modaldemandecredit')]
    public function ModalDemandeCredit(Request $request)
    {
        $form=$this->createForm(DemandeCreditModalType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $data=$form->getData();

            $typeclient=$data['TypeClient'];
            // Individuel
            $CodeClient=$data['CodeClient'];
            $nom=$data['nom'];
            $prenom=$data['prenom'];
            $codeclient=$data['codeclient'];

            // Groupe

            $nomgroupe=$data['nomgroupe'];
            $codegroupe=$data['codegroupe'];


    
    
            $CodeGroupe=$data['CodeGroupe'];

            return $this->redirectToRoute('app_demande_credit_new',
            [
                'TypeClient'=>$typeclient,
                'CodeClient'=>$CodeClient,
                'nom'=>$nom,
                'prenom'=>$prenom,
                'codeclient'=>$codeclient,
                'CodeGroupe'=>$CodeGroupe,
                'nomgroupe'=>$nomgroupe,
                'codegroupe'=>$codegroupe
            ],Response::HTTP_SEE_OTHER);

        }
        return $this->renderForm('demande_credit/ModalDemandeCredit.html.twig',
        [
            'form'=>$form,
        ]
    );
    }
}