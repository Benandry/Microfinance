<?php

namespace App\Controller\Credit\Decaissement;

use App\Repository\DecaissementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DecaissementCreditController extends AbstractController
{
    #[Route('/decaissement/credit/individuel', name: 'app_decaissement_credit_individuel')]
    public function individuel(DecaissementRepository $decaissementRepository): Response
    {
        $listeDemandeApprouver = $decaissementRepository->decaissementApprouverIndividuel();
        // dd($listeDemandeApprouver);

        return $this->render('Module_credit/decaissement/individuel.html.twig', [
            'demandeApprouver' => $listeDemandeApprouver ,
        ]);
    }

    #[Route('/decaissement/credit/groupe', name: 'app_decaissement_credit_groupe')]
    public function groupe(DecaissementRepository $decaissementRepository): Response
    {
        $listeDemandeApprouver = $decaissementRepository->decaissementApprouverGroupe();

        return $this->render('Module_credit/decaissement/groupe.html.twig', [
            'demandeApprouver' => $listeDemandeApprouver ,
        ]);
    }
}