<?php

namespace App\Controller\Credit;

use App\Form\ReechelonnementModalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReechelonnementModalController extends AbstractController
{

    /**
     * Undocumented function
     *
     * @method mixed ReechelonnementIndividuelModal():Methode permet de recuperer les information dans le modal reechelonnement
     * @param Request $request
     * @return Response
     */
    #[Route('/Reechelonnement/Individuel',name:'app_reechelonnement_individuel')]
    public function ReechelonnementIndividuelModal(Request $request):Response
    {
        $form=$this->createForm(ReechelonnementModalType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data=$form->getData();

            $CodeCredit=$data['CodeCredit'];
            $nom=$data['nom'];
            $prenom=$data['prenom'];
            $codeclient=$data['codeclient'];
            $NumeroCredit=$data['NumeroCredit'];
            $SommeDejaRembourser=$data['SommeDejaRembourser'];
            $MontantDecaisser=$data['MontantDecaisser'];
            $InteretCredit=$data['InteretCredit'];
            $Periode=$data['Periode'];
            $DernierPeriode=$data['DernierPeriode'];
            $ResteCapital=$data['ResteCapital'];
            $ResteInteret=$data['ResteInteret'];

            return $this->redirectToRoute('app_reechelonnement_controller',
                [
                    'CodeCredit'=>$CodeCredit,
                    'nom'=>$nom,
                    'prenom'=>$prenom,
                    'codeclient'=>$codeclient,
                    'NumeroCredit'=>$NumeroCredit,
                    'SommeDejaRembourser'=>$SommeDejaRembourser,
                    'MontantDecaisser'=>$MontantDecaisser,
                    'InteretCredit'=>$InteretCredit,
                    'Periode'=>$Periode,
                    'DernierPeriode'=>$DernierPeriode,
                    'ResteCapital'=>$ResteCapital,
                    'ResteInteret'=>$ResteInteret,

                ],Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('Module_credit/Reechelonnement/ReechelonnementModal.html.twig',
                [
                    'form'=>$form
                ]    
    );
    }
}