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
}
