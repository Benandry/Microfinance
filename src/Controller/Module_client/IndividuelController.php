<?php

namespace App\Controller\Module_client;

use App\Entity\Individuelclient;
use App\Entity\Agence;
use App\Form\IndividuelclientType;
use App\Form\AgenceType;
use App\Form\FiltreIndividuelType;
use App\Form\RechercheIndividuelType;
use App\Repository\AgenceRepository;
use App\Repository\IndividuelclientRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/individuel')]
class IndividuelController extends AbstractController
{
    #[Route('/', name: 'app_individuel_index')]
    public function index(Request $request,IndividuelclientRepository $individuelclientRepository,AgenceRepository $agenceRepository): Response
    {

        $individuel=$individuelclientRepository->Client();

        // Recherche

        $formulaire=$this->createForm(RechercheIndividuelType::class);
        $Chercher=$formulaire->handleRequest($request);

        if($formulaire->isSubmitted() && $formulaire->isValid()){
           // dd($Chercher);
            $individuel=$individuelclientRepository->Recherche($Chercher->getData()) ;
        }

           // Filtre entre deux date

        $filtre=$this->createForm(FiltreIndividuelType::class);
        $filtreDate=$filtre->handleRequest($request);

        if($filtre->isSubmitted() && $filtre->isValid()){
            $date_debut = $filtreDate->getData()['Date1'];
            $date_fin = $filtreDate->getData()['Date2'];
            
            $individuel=$individuelclientRepository->trierRapportClient($date_debut,$date_fin);
        }

        // $filtre=$individuelclientRepository->trierRapportClient($date1,$date2);

        return $this->renderForm('Module_client/individuel/index.html.twig', [
            'individuelclients' => $individuel,
            'agences' => $agenceRepository->findAll(),
            'formulaire'=>$formulaire,
            'filtre'=>$filtre,
        ]);
    }
    
    #[Route('/new', name: 'app_individuel_new', methods: ['GET', 'POST'])]

    public function new(AgenceRepository $agence,ManagerRegistry $doctrine,Request $request, IndividuelclientRepository $individuelclientRepository,FileUploader $fileUploader,EntityManagerInterface $entityManagerInterface): Response
    {


        // Maka an ilay client farany

        $get_last_client = $individuelclientRepository->findByLastClient();

        #dd($get_last_client[0][1]);
        if ($get_last_client[0][1]== NULL ) {
            $lastClient = 0;
        }else{
            $lastClient = $get_last_client[0][1];
        }
        
        ///MAKA an ilay id agence ///

        $get_id_agence = $individuelclientRepository->findByAgenceCode();
       // dd($get_id_agence);
        if ($get_id_agence == NULL ) {
            $agence_client = 0;
        }else{
            $agence_client = $get_id_agence[0]['id'];
        }


        $individuelclient = new Individuelclient();
        $agences=new Agence();
        #dd($individuelclient);
        $form = $this->createForm(IndividuelclientType::class, $individuelclient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        $brochureFile = $form->get('photo')->getData();
        if ($brochureFile) {
            $brochureFileName = $fileUploader->upload($brochureFile);
            $individuelclient->setPhoto($brochureFileName);
        }
        $individuelclientRepository->add($individuelclient,True);
            $this->addFlash('success', "Ajout de nouveau client:  ' ".$individuelclient-> getNomClient()."  " . $individuelclient->getPrenomClient()." ' avec code ".$individuelclient->getCodeclient()."  reussite!!");
            return $this->redirectToRoute('app_individuel_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_client/individuel/new.html.twig', [
            'individuelclient' => $individuelclient,
            'form' => $form,
            'lastClient' =>$lastClient, 
            'agence_client' =>$agence_client,
        ]);
    }

    #[Route('/{id}', name: 'app_individuel_show', methods: ['GET'])]
    // #[ParamConverter('get',class:'SensioBlogBundle:Get')]
    public function show(ManagerRegistry $docrtine,Individuelclient $individuelclient,AgenceRepository $agenceRepository,int $id): Response
    {
        $individuelclient=$docrtine->getRepository(Individuelclient::class)->find($id);
        $Commune=$individuelclient->getCommune();

        //dd($Commune);
        $etude=$individuelclient->getEtude();
        $titre=$individuelclient->getTitre();
        $etatcivile=$individuelclient->getEtatcivile();
        //Agence
        $agence=$agenceRepository->findAll(); 

        return $this->render('Module_client/individuel/show.html.twig', [
            'individuelclients' => $individuelclient,
            'Commune'=>$Commune,
            'agences' => $agence,
            'etudes' => $etude,
            'titres' => $titre,
            'etatciviles' => $etatcivile,
        ]);
    }

#[Route('/{id}/edit', name: 'app_individuel_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Individuelclient $individuelclient, IndividuelclientRepository $individuelclientRepository,FileUploader $fileUploader,EntityManagerInterface $entityManagerInterface,$id): Response
    {
       // $client = new Individuelclient();
       // dd($client);
        $form = $this->createForm(IndividuelclientType::class, $individuelclient);
        $form->handleRequest($request);
        
       // dd($form);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('photo')->getData();
            if ($brochureFile) {
                $brochureFileName = $fileUploader->upload($brochureFile);
                $individuelclient->setPhoto($brochureFileName);
            }
    
            $individuelclientRepository->add($individuelclient, true);
            $this->addFlash('success', "Modification du client ' ".$individuelclient-> getNomClient()."  " . $individuelclient->getPrenomClient()."  ' avec code ".$individuelclient->getCodeclient()."  reussite!!");
            return $this->redirectToRoute('app_individuel_index', [], Response::HTTP_SEE_OTHER);
        }

        /// Maka an ilay client ho modifierna ///
        $clientToModify = $individuelclientRepository->FindByClientToModify($id);
        $nom = $clientToModify[0]['nom_client'];
       // dd($nom);
       ######## dd($clientToModify);

        return $this->renderForm('Module_client/individuel/edit.html.twig', [
            'individuelclient' => $individuelclient,
            'form' => $form,
            'clientToModify' => $clientToModify[0]['id'],
            'nom_client' => $nom,
        ]);
    }

    #[Route('/{id}', name: 'app_individuel_delete', methods: ['POST'])]
    public function delete(Request $request, Individuelclient $individuelclient, IndividuelclientRepository $individuelclientRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$individuelclient->getId(), $request->request->get('_token'))) {
            $individuelclientRepository->remove($individuelclient, true);
        }
        $this->addFlash('success', "Suppression du client ' ".$individuelclient-> getNomClient()." " . $individuelclient->getPrenomClient()."  ' avec code ".$individuelclient->getCodeclient()."  reussite!!");
        return $this->redirectToRoute('app_individuel_index', [], Response::HTTP_SEE_OTHER);
    }

}
