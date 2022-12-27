<?php

namespace App\Controller\Credit\Decaissement;

use App\Repository\DecaissementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DecaissementCreditController extends AbstractController
{
    #[Route('/decaissement/credit', name: 'app_decaissement_credit')]
    public function index(Request $request,DecaissementRepository $decaissementRepository): Response
    {
        $listeDemandeApprouver = $decaissementRepository->decaissementApprouver();

        //dd($listeDemandeApprouver);
        
        // $codecredit  = $request->request->get('codecredit');
        // if($codecredit == null){
        //     return $this->redirectToRoute('app_decaissement_credit', [], Response::HTTP_SEE_OTHER);
        // }else{
        //    $demandeApprouver = $decaissementRepository->decaissementApprouver($codecredit);
        //    if($demandeApprouver == null){
        //         dd("Demande en attende d'approbation");
        //    }else {
        //         if($demandeApprouver[0]['statusApprobation'] == 'approuvé'){
        //             dd($demandeApprouver);
        //         }
        //         elseif ($demandeApprouver[0]['statusApprobation'] == 'Rejeté') {
        //             # code...
        //         }
        //    }
        // }

        return $this->render('Module_credit/decaissement/index.html.twig', [
            'demandeApprouver' => $listeDemandeApprouver ,
        ]);
    }
}