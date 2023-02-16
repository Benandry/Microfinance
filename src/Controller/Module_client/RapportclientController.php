<?php

namespace App\Controller\Module_client;

use App\Entity\Agence;
use App\Entity\Commune;
use App\Form\FiltreRapportGroupeType;
use App\Form\TrierRapportClientType;
use App\Repository\AgenceRepository;
use App\Repository\GroupeRepository;
use App\Repository\IndividuelclientRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\FiltreRapportMembreType;
use App\Form\RapportClientType;
use App\Repository\CommuneRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RapportclientController extends AbstractController
{
    #[Route('/rapportclient', name: 'app_rapportclient')]
    public function index(Request $request,IndividuelclientRepository $individuelclients,AgenceRepository $agence,CommuneRepository $communeRepository): Response
    {
       // dd(" Mbola eto aloha");
       $clients=$individuelclients->findAllClient();
       //dd($clientRapport);

       $form=$this->createForm(RapportClientType::class);
       $form->handleRequest($request);

       $affiche_tab = false ;
        $data['search_one_date'] = '';
        $data['date1'] = '';
        $data['date2'] = '';

          #--------------Titre rapport client ---------------------------#
         $titre = "";

       if($form->isSubmitted() && $form->isValid()){
            $affiche_tab = true;
            $data = $form->getData();

            //Filtrer le client par groupe
            if ($data['groupe']) {
               $clients = $individuelclients->FindByClientByGroupe($data['groupe']);
               $titre = "Listes des clients du groupe ".$data['groupe']->getNomGroupe();
            }
            elseif ($data['nomAgence']) {//Filtre client par agence 
                $clients = $agence->findClientParAgence($data['nomAgence']);
                $titre = "Listes des clients par l'agence ".$data['nomAgence']->getNomAgence();
            }elseif ($data['commune']) {  //Filtre client par commune 
                $clients = $communeRepository->findClientParCommune($data['commune']);
                $titre = "Listes des clients de la commune ".$data['commune']->getNomCommune();
            }
            elseif ($data['search_one_date']) {//Filtre client par une date 
                $clients = $individuelclients->trierRapportClientPar_une_date($data['search_one_date']);
            } elseif ($data['agent']) {//Filtre client par agent 
                $titre = "Listes de client de l'agent ".$data['agent']->getNom()." ".$data['agent']->getPrenom();
                $clients = $individuelclients->findClientByAgent($data['agent']);
            }
            else {//Filtre client par deux date 
                $date_debut = $data['date1'];
                $date_fin = $data['date2'];
                $clients=$individuelclients->trierRapportClient($date_debut,$date_fin);
                // dd($clients);
            }
        }
        // dd($data['search_one_date']);
        return $this->renderForm('Module_client/rapportclient/index.html.twig', [
            'individuel' => $clients,
            'agences'=>$agence->findAll(),
            'trier'=>$form,
            'affiche_tab' => $affiche_tab,
            'titre' => $titre,
            'date_one' => $data['search_one_date'],
            'date1' => $data['date1'],
            'date2' => $data['date2']

        ]);
    }
    //Cette fonctin permet de faire des trie en groupe
    #[Route('/rapportgroupe', name: 'app_rapportgroupe')]
    public function RapportGroupeTrier(Request $request,GroupeRepository $groupeRepository,AgenceRepository $agence): Response
    {
       #$groupeRapport=$groupeRepository->findAll();
       $groupeRapport = $groupeRepository->findByNumberClienByGroupe();

       $affiche_tab = false ;
        //    $trierGroupe=$groupeRepository->FiltreGroupe($date1,$date2);
       $trierGroupe=$this->createForm(FiltreRapportGroupeType::class);
       $filtrerapportdate=$trierGroupe->handleRequest($request); 

         #--------------Date afficher ---------------------------#
         $date_1 = false;
         $date_2 = false;
         $date_debut = 0;
         $date_fin = 0;
         $one_date = 0;

       if($trierGroupe->isSubmitted() && $trierGroupe->isValid()){
            $affiche_tab = true ;
            $data = $filtrerapportdate->getData();

            $one_date = $data['one_date_search'];
            if ($one_date != null) {
                $date_1 = true;
                $groupeRapport = $groupeRepository->filtre_groupe_one_date($one_date);
                //dd($one_date);
            }
            else 
            {
                $date_2 = true;
                $date_debut = $data['Date1'];
                $date_fin = $data['Date2'];
    
                $groupeRapport = $groupeRepository->FiltreGroupe($date_debut,$date_fin);    
            }
        
       }
       
       
        return $this->renderForm('Module_client/rapport_groupe/index.html.twig', [
            'groupe' => $groupeRapport,
            'agences'=>$agence->findAll(),
            'trierGroupe'=>$trierGroupe,
            'affiche_tab' => $affiche_tab,
            'date_1' => $date_1,
            'date_2' => $date_2,
            'one_date' => $one_date,
            'du'=>$date_debut,
            'au' =>$date_fin,
        ]);
    }

}
