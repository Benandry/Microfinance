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

        if($form->isSubmitted() && $form->isValid()){
            $data= $form->getData();

            $typeclient=$data['typeclient'];
            $codecredit=$data['codecredit'];
            $penalite=$data['penaliteprecedent'];
            $montant=$data['montantprecedent'];
            $montantdu=$data['montantdu'];
            $periode=$data['periode'];
            $restemontant=$data['restemontant'];
            $crd=$data['crd'];
            // dd($codecredit);

            return $this->redirectToRoute('app_remboursement_credit_new',
            [
                'typeclient'=>$typeclient,
                'codecredit'=>$codecredit,
                'penalite'=>$penalite,
                'montant'=>$montant,
                'montantdu'=>$montantdu,
                'periode'=>$periode,
                'restemontant'=>$restemontant,
                'crd'=>$crd

            ],Response::HTTP_SEE_OTHER);

        }
        return $this->renderForm('remboursement/remboursement_modal/index.html.twig', [
            'typeclient'=>'typeclient',
            'codecredits' => 'codecredit',
            'penalite'=> 'penalite',
            'montant'=>'montant',
            'periode'=>'periode',
            'montantdu'=>'montantdu',
            'crd'=>'crd',
            'restemontant'=>'restemontant',
            'form'=>$form
        ]);
    }
}
