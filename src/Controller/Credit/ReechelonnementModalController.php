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

            return $this->redirectToRoute('app_reechelonnement_controller',
                [
                    'CodeCredit'=>$CodeCredit,
                    'nom'=>$nom,
                    'prenom'=>$prenom,
                    'codeclient'=>$codeclient,
                ],Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('Module_credit/Reechelonnement/ReechelonnementModal.html.twig',
                [
                    'form'=>$form
                ]    
    );
    }
}