<?php

namespace App\Controller\Comptabilite;

use App\Repository\MouvementComptableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JournalController extends AbstractController
{
    #[Route('/comptabilite/journal', name: 'app_journal_compta')]
    public function index(MouvementComptableRepository $mouvementComptableRepository): Response
    {
        $journal = $mouvementComptableRepository->findJournal();
        // dd($journal);
        return $this->render('journal/index.html.twig', [
            'journals' => $journal, 
        ]);
    }
}
