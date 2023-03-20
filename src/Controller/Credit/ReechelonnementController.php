<?php

namespace App\Controller\Credit;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReechelonnementController extends AbstractController
{
    /**
     * Undocumented function
     *
     * @method mixed Reechelonnement():Fonction permet de reechelonner les credits
     * @param Request $request
     * @return Response
     */
    #[Route('/Reechelonnment/Controller/Individuel/',name:'app_reechelonnement_controller')]
    public function Reechelonnement(Request $request)
    {
        // Recuperer les donnees vient du modal
        $idclient=$request->query->get('CodeCredit');
        $nom=$request->query->get('nom');
        $prenom=$request->query->get('prenom');
        $codeclient=$request->query->get('codeclient');
        
    }
}