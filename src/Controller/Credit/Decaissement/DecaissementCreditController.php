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
        return $this->render('Module_credit/decaissement/index.html.twig', [
            'demandeApprouver' => $listeDemandeApprouver ,
        ]);
    }
}