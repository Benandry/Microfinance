<?php

namespace App\Controller\Comptabilite;

use App\Repository\MouvementComptableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtatController extends AbstractController
{
    #[Route('/comptabilite/journal', name: 'app_journal_compta')]
    public function journal(MouvementComptableRepository $mouvementComptableRepository): Response
    {
        $journal = $mouvementComptableRepository->findJournal();
        // dd($journal);
        return $this->render('Comptabilite/journale.html.twig', [
            'journals' => $journal, 
        ]);
    }

    #[Route('/comptabilite/grande/livre', name: 'app_compta_grand_livre')]
    public function grandLivre(MouvementComptableRepository $mouvementComptableRepository): Response
    {
        $grandLivre = $mouvementComptableRepository->findByGrandLivre();
        // dd($journal);
        return $this->render('Comptabilite/livre.html.twig', [
            'livres' => $grandLivre, 
        ]);
    }
}
