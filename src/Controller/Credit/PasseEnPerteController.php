<?php

namespace App\Controller\Credit;

use App\Entity\PasseEnPerte;
use App\Form\PasseEnPerteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PasseEnPerteController extends AbstractController
{
    #[Route('/Perte/Credit/',name:'app_credit_perte')]
    public function PasseEnPerte(Request $request,EntityManagerInterface $em)
    {   
        // Recuperation du donnees venant du modal
        $NumeroCredit=$request->query->get('NumeroCredit');
        $CodeCredit=$request->query->get('CodeCredit');
        $CodeClient=$request->query->get('CodeClient');
        $NomClient=$request->query->get('NomClient');
        $PrenomClient=$request->query->get('PrenomClient');

        // Instanciation de l'entite passe en perte
        $perte=new PasseEnPerte();

        
        $form=$this->createForm(PasseEnPerteType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            // Inserer le numero credit vers la base
            $perte->setNumeroCredit($CodeCredit);

            $PasseEnPerte=$perte->isPasseEnPerte();
            $perte->setPasseEnPerte($PasseEnPerte);

            $em->persist($perte);
            $em->flush();

            $this->addFlash('success','Le credit est passee en perte');
        }

        return $this->renderForm('Module_credit/Perte/PasseEnPerte.html.twig',[
            'CodeCredit'=>$CodeCredit,
            'CodeClient'=>$CodeClient,
            'NomClient'=>$NomClient,
            'PrenomClient'=>$PrenomClient,
            'form'=>$form
        ]);
    }
}
