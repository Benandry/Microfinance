<?php

namespace App\Controller\Credit;

use App\Form\RemboursementModalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RemboursementModalController extends AbstractController
{
    #[Route('/modal/remboursement', name: 'app_remboursement_modal')]
    public function index(Request $request):Response
    {
        $form=$this->createForm(RemboursementModalType::class);
        $form->handleRequest($request);

<<<<<<< HEAD

        if($form->isSubmitted() && $form->isValid()){
            $data= $form->getData();

            $codecredit=$data['codecredit'];
=======
        if($form->isSubmitted() && $form->isValid()){
            $data= $form->getData();

            $typeclient=$data['typeclient'];
            $codecredit=$data['codecredit'];
            $penalite=$data['penaliteprecedent'];
            $montant=$data['montantprecedent'];
            $montantdu=$data['montantdu'];
            $periode=$data['periode'];
            $restemontant=$data['restemontant'];
>>>>>>> refs/remotes/origin/main
            // dd($codecredit);

            return $this->redirectToRoute('app_remboursement_credit_new',
            [
<<<<<<< HEAD
                'codecredit'=>$codecredit
=======
                'typeclient'=>$typeclient,
                'codecredit'=>$codecredit,
                'penalite'=>$penalite,
                'montant'=>$montant,
                'montantdu'=>$montantdu,
                'periode'=>$periode,
                'restemontant'=>$restemontant,
>>>>>>> refs/remotes/origin/main

            ],Response::HTTP_SEE_OTHER);

        }
        return $this->renderForm('remboursement/remboursement_modal/index.html.twig', [
<<<<<<< HEAD
            'codecredits' => 'codecredit',
=======
            'typeclient'=>'typeclient',
            'codecredits' => 'codecredit',
            'penalite'=> 'penalite',
            'montant'=>'montant',
            'periode'=>'periode',
            'montantdu'=>'montantdu',
            'restemontant'=>'restemontant',
>>>>>>> refs/remotes/origin/main
            'form'=>$form
        ]);
    }
}
