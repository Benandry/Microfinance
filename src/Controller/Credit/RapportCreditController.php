<?php

namespace App\Controller\Credit;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ApprobationCreditRepository;

class RapportCreditController extends AbstractController
{

    #[Route('/rapport/credit/approuver', name: 'app_rapport_credit_approuver')]
    public function index(ApprobationCreditRepository $approRepo): Response
    {
         $listeApprouver = $approRepo->getDemandeApprouver('approuvé');
       // $listeApprouver = $approRepo->findDemandeNonApprouver();
       // dd($listeApprouver);
        return $this->render('Module_credit/rapportCredit/demande_approuver.html.twig',[
            'listeApprouver' => $listeApprouver,
        ]);
    }

    #[Route('/rapport/credit/rejeter', name: 'app_rapport_credit_rejeter')]
    public function rejeter(ApprobationCreditRepository $approRepo): Response
    {
        $listeRejeter = $approRepo->getDemandeApprouver('Rejeté');
        //dd($listeApprouver);
        return $this->render('Module_credit/rapportCredit/demande_rejeter.html.twig',[
            'listeRejeter' => $listeRejeter,
        ]);
    }

    #[Route('/rapport/credit/differer', name: 'app_rapport_credit_differer')]
    public function differer(ApprobationCreditRepository $approRepo): Response
    {
        $listeDifferer = $approRepo->getDemandeApprouver('Différée');
        //dd($listeApprouver);
        return $this->render('Module_credit/rapportCredit/demande_differer.html.twig',[
            'listeDifferer' => $listeDifferer,
        ]);
    }
}