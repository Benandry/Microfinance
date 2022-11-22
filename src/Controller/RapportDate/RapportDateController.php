<?php

namespace App\Controller\RapportDate;

use App\Repository\IndividuelclientRepository;
use App\Repository\IndividuelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RapportDateController extends AbstractController
{
    #[Route('/rapport/date', name: 'app_rapport_date')]
    public function index(IndividuelclientRepository $individuelRepository): Response
    {
        $individuelJson=$individuelRepository->findAll();
        // 
        // $data=array();
        // $idx=0;
        // foreach($transactions as $transaction){
        //     $temp=array(
        //         'codetransaction'=>$transaction->getCodetransaction(),
        //         'solde'=>$transaction->getSolde(),
        //         'Montant'=>$transaction->getMontant()
        //     );
        //     $data[$idx++]=$temp;
            
        // }

        // 
        $data=array();
        $idx=0;

        foreach($individuelJson as $individuel ){
            $temp=array(
                'id'=>$individuel->getId(),
                'nom_client'=>$individuel->getNomclient(),
                'prenom_client'=>$individuel->getPrenomclient(),
                'cin'=>$individuel->getCin(),
                'date_inscription'=>$individuel->getDateinscription()
            );
        };

        $data[$idx++]=$temp;

        return new JsonResponse($data);
    }
}
