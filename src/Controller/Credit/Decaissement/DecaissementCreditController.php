<?php

namespace App\Controller\Credit\Decaissement;

use App\Repository\DecaissementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DecaissementCreditController extends AbstractController
{
    #[Route('/decaissement/credit/individuel/', name: 'app_decaissement_credit_individuel')]
    public function individuel(Request $request,DecaissementRepository $decaissementRepository): Response
    {
        $Client=$request->query->get('Client');
        $nomclient=$request->query->get('nomclient');
        $prenomclient=$request->query->get('prenomclient');
        $numerocredit=$request->query->get('numerocredit');
        $montantcredit=$request->query->get('montantcredit');
        dd($Client,$nomclient,$prenomclient,$numerocredit,$montantcredit);

        $listeDemandeApprouver = $decaissementRepository->decaissementApprouverIndividuel($Client);
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