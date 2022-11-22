<?php

namespace App\Controller\Module_client;

use App\Entity\Individuelclient;
use App\Form\FiltreRapportDocumentIdentiteType;
use App\Repository\IndividuelclientRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RapportdocumentidentiteController extends AbstractController
{
    #[Route('/rapportdocumentidentite', name: 'app_rapportdocumentidentite')]
    public function Rapport(Request $request,IndividuelclientRepository $individuelclientRepository): Response
    {
        $rapportdoc=$individuelclientRepository->findAll();
        //    $trierGroupe=$groupeRepository->FiltreGroupe($date1,$date2);
       $trierDoc=$this->createForm(FiltreRapportDocumentIdentiteType::class);
       $filtrerapportdate=$trierDoc->handleRequest($request);
       $afficher_table = false;


       /*********Afficher les par les recherche de date */
        $date_1 = false;
        $date_2 = false;
        $date_debut = 0;
        $date_fin = 0;
        $one_date = 0;
        /********************************************************** */

       if($trierDoc->isSubmitted() && $trierDoc->isValid()){
        $data = $filtrerapportdate->getData();

        $one_date = $data['one_date_search'];

        if ($one_date != null) {
            $date_1 = true;
            $rapportdoc= $individuelclientRepository->trierRapportClient_one_date($one_date);  
            //dd($rapportdoc); 
        }else {
            $date_2 = true;
            $date_debut = $data['Date1'];
            $date_fin = $data['Date2'];
            $rapportdoc= $individuelclientRepository->trierRapportClient($date_debut,$date_fin);   
            //dd($rapportdoc);
        }
        $afficher_table = true;
       }
        // $filtreRapportDocument=$individuelclientRepository->FiltreRappport();
        return $this->renderForm('Module_client/rapportdocumentidentite/index.html.twig', [
            'documents' => $rapportdoc,
            'trierDocs'=>$trierDoc,
            'affiche_table'=>$afficher_table,
            'date_1' => $date_1,
            'date_2' => $date_2,
            'one_date' => $one_date,
            'du'=>$date_debut,
            'au' =>$date_fin,
        ]);
    }
}