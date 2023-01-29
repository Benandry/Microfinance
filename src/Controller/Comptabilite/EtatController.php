<?php

namespace App\Controller\Comptabilite;

use App\Repository\MouvementComptableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtatController extends AbstractController
{
    #[Route('/comptabilite/journal', name: 'app_journal_compta')]
    public function journal(Request $request,MouvementComptableRepository $mouvementComptableRepository): Response
    {
        $affiche_tab = false;

        $journal = [];
        
        $debut = null;
        $fin= null;

        $form = $this->createFormBuilder()
        ->add('debut',DateType::class,[
            'label' => 'du',
            'format' => 'yyyy-MM-dd',
            'html5'=>true,
            'widget' => 'single_text',
        ])
        ->add('fin',DateType::class,[
            'label' => 'au',
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
            'html5'=>true,
        ])

        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $affiche_tab = true;
            $data = $form->getData();
            $debut = $data['debut'];
            $fin = $data['fin'];

            $journal = $mouvementComptableRepository->findJournal($debut,$fin);
        }

        // dd($journal);
        $sumDebit = array_sum(array_column($journal,'credit'));
        $sumCredit = array_sum(array_column($journal,'credit'));

        // dd($sumCredit);

        return $this->renderForm('Comptabilite/journale.html.twig', [
            'journals' => $journal, 
            'afficher' => $affiche_tab,
            'form' => $form,
            'debut' => $debut, 
            'fin' => $fin, 
            'totalDebit' => $sumDebit,
            'totalCredit' => $sumCredit
        ]);
    }

    #[Route('/comptabilite/grande/livre', name: 'app_compta_grand_livre',methods: ['GET','POST'])]
    public function grandLivre(Request $request, MouvementComptableRepository $mouvementComptableRepository): Response
    {
        $affiche_tab = false;
        $grandLivre = $mouvementComptableRepository->findAll();
        // dd();
        $debut = null;
        $fin = null;

        $form = $this->createFormBuilder()
            ->add('debut',DateType::class,[
                'label' => 'du',
                'format' => 'yyyy-MM-dd',
                'html5'=>true,
                'widget' => 'single_text',
            ])
            ->add('fin',DateType::class,[
                'label' => 'au',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'html5'=>true,
            ])

            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $affiche_tab = true;
            $data = $form->getData();

            $debut = $data['debut'];
            $fin = $data['fin'];

            $grandLivre = $mouvementComptableRepository->findByGrandLivre($debut,$fin);
            // dd($grandLivre);
        }

        $sumDebit = array_sum(array_column($grandLivre,'debit'));
        $sumCredit = array_sum(array_column($grandLivre,'credit'));


        return $this->renderForm('Comptabilite/livre.html.twig', [
            'livres' => $grandLivre, 
            'affiche_tab' => $affiche_tab,
            'form' => $form,
            'debut' =>$debut,
            'fin' => $fin,
            'totalDebit' => $sumDebit,
            'totalCredit' => $sumCredit,
        ]);
    }

    
    #[Route('/comptabilite/balance', name: 'app_compta_balance',methods: ['GET','POST'])]
    public function balance(Request $request,MouvementComptableRepository $mouvementComptableRepository ):Response
    {
        $classe1 = $mouvementComptableRepository->getBalance();
        // $classe2 = $mouvementComptableRepository->getBalance(2);
        // $classe3 = $mouvementComptableRepository->getBalance(3);
        // $classe4 = $mouvementComptableRepository->getBalance(4);
        // $classe5 = $mouvementComptableRepository->getBalance(5);
        // $classe6 = $mouvementComptableRepository->getBalance(6);
        // $classe7 = $mouvementComptableRepository->getBalance(7);

        // dd($classe1);
        return $this->renderForm("Comptabilite/balance.html.twig",[
            'classe1' => $classe1,
        //     'classe2' => $classe2,
        //     'classe3' => $classe3,
        //     'classe4' => $classe4,
        //     'classe5' => $classe5,
        //     'classe6' => $classe6,
        //     'classe7' => $classe7,
        ]);
    }
}
