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

            $codecredit=$data['codecredit'];
            // dd($codecredit);

            return $this->redirectToRoute('app_remboursement_new',
            [
                'codecredit'=>$codecredit

            ],Response::HTTP_SEE_OTHER);

        }
        return $this->renderForm('remboursement/remboursement_modal/index.html.twig', [
            'codecredits' => 'codecredit',
            'form'=>$form
        ]);
    }
}
