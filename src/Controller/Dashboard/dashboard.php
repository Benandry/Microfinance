<?php

namespace App\Controller\Dashboard;

use App\Repository\EtudeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class dashboard extends AbstractController
{
    #[Route('/',name: 'app_dashboard')]
    public function index(EtudeRepository $repoEtude):Response
    {
        // dd($this->getUser()->getRoles()[0]);
        $nombreClientTotal = $repoEtude->nombreClient();
        $nombreGroupe = $repoEtude->nombreGroupe();
        $nombreCompteEpargne = $repoEtude->nombreEpargne();
        $nombreAgence = $repoEtude->nombreAgence();
        $compteCredit = $repoEtude->nombreCompteCredit();

        // dd($compteCredit);
        
        return $this->render('Dashboard/dashboard.html.twig',[
            'clientTotal' => $nombreClientTotal,
            'groupeTotal' => $nombreGroupe,
            'compteEparne' => $nombreCompteEpargne,
            'agence' => $nombreAgence,
            'credit' => $compteCredit,
        ]);
    }
}
?>