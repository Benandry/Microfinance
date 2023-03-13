<?php

namespace App\Controller\Credit;

use App\Entity\ProduitCredit;
use App\Form\ModalConfigurationCreditType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModalConfigurationCreditController extends AbstractController
{

    #[Route('ModalConfiguration/Credit/',name:'app_configuration_modal_credit')]
    public function ModalConfiguration(Request $request,EntityManagerInterface $entityManager):Response
    {
        $produitCredit=new ProduitCredit();

        $form=$this->createForm(ModalConfigurationCreditType::class,$produitCredit,[
            'em'=>$entityManager,
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $ProduitCredit=$form->get('ProduitCredit')->getData();

            return $this->redirectToRoute('app_configuration_credit_new',[
                'ProduitCredit'=>$ProduitCredit
            ],Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('configuration_credit/ModalConfigurationCredit.html.twig',
            [
                'form'=>$form,
                'ProduitCredit'=>'ProduitCredit'
            ]
        );
    }
}