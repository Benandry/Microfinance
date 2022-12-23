<?php

namespace App\Controller\Credit;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ApprobationCreditRepository;
use App\Repository\DemandeCreditRepository;
use App\Form\RapportCreditType;
use Symfony\Component\HttpFoundation\Request;

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

    #[Route('/rapport/demande/credit', name: 'app_rapport_demande_credit')]
    public function demandeCredit(DemandeCreditRepository $repoDemande,Request $request): Response
    {
        $trierDoc=$this->createForm(RapportCreditType::class);
        $filtrerapportdate=$trierDoc->handleRequest($request);
        $afficher_table = false;

        $affiche_tab = false ;

        #--------------Date afficher ---------------------------#
        $date_1 = false;
        $date_2 = false;
        $date_debut = 0;
        $date_fin = 0;
        $one_date = 0;

        if($trierDoc->isSubmitted() && $trierDoc->isValid()){
            $data = $filtrerapportdate->getData();
    
            $one_date = $data['one_date_search'];
    
            if ($one_date != null) {
                $date_1 = true;
                $rapportDemande = $repoDemande->findDemnadeCredit('5555','5555'); 
                //dd($rapportdoc); 
            }else {
                $date_2 = true;
                $date_debut = $data['Date1'];
                $date_fin = $data['Date2'];
                $rapportDemande = $repoDemande->findDemnadeCredit('5555','5555');   
                //dd($rapportdoc);
            }
            $afficher_table = true;
        }

        return $this->render('Module_credit/rapportCredit/demande_credit.html.twig',[
            'listeDifferer' => $rapportDemande,
            'trierDocs'=>$trierDoc,
        ]);
    }
}