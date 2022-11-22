<?php

namespace App\Controller\Module_client;

use App\Entity\Agence;
use App\Entity\Groupe;
use App\Entity\Individuelclient;
use App\Entity\MembreGroupe;
use App\Form\FiltreRapportMembreType;
use App\Form\GroupeType;
use App\Repository\AgenceRepository;
use App\Repository\GroupeRepository;
use App\Repository\MembreGroupeRepository;
use App\Repository\IndividuelclientRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\PersistentCollection;

#[Route('/groupe')]
class GroupeController extends AbstractController
{
    #[Route('/', name: 'app_groupe_index', methods: ['GET'])]
    public function index(GroupeRepository $groupeRepository,AgenceRepository $agence): Response
    {
        #dd($groupeRepository->Groupe());
        return $this->render('Module_client/groupe/index.html.twig', [
            'groupes' => $groupeRepository->Groupe(),
            'agences'=>$agence->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_groupe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GroupeRepository $groupeRepository,IndividuelclientRepository $individuel): Response
    {
        // ========= Maka code groupe
        $get_id_groupe = $groupeRepository->findByGroupId();

        if ($get_id_groupe[0][1] == NULL) {
            $last_id_gropue = 0;
        }else {
            $last_id_gropue = $get_id_groupe[0][1];
        }
        // ============ MAka aagence  ====

        $get_id_agence = $individuel->findByAgenceCode();
        #dd($get_id_agence);
        if ($get_id_agence == NULL ) {
            $agence_client = 0;
        }else{
            $agence_client = $get_id_agence[0]['id'];
        }
       # agence_client = 0
      #  dd($agence_client);


        $groupe = new Groupe();
        $form = $this->createForm(GroupeType::class, $groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          //  dd($form->getData());

            $groupeRepository->add($groupe, true);
            
            $this->addFlash('success', "Ajout du nouveau ' ".$groupe-> getNomGroupe()." ' avec code ".$groupe->getCodegroupe()."  reussite!!");
            //return $this->redirectToRoute('app_groupe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_client/groupe/new.html.twig', [
            'groupe' => $groupe,
            'form' => $form,
            'last_id_gropue' => $last_id_gropue,
            'id_agence' => $agence_client,
        ]);
    }

    #[Route('/show/{id}', name: 'app_groupe_show')]
    public function show(ManagerRegistry $doctrine,$id): Response
    {        
        $groupes=$doctrine->getRepository(Groupe::class)->find($id);
        $membre=$groupes->getIndividuelMembre();

        // Agence
        $agence=$doctrine->getRepository(Agence::class)->findAll();

        return $this->render('Module_client/groupe/show.html.twig',
                [
                    'agences'=>$agence,
                    'membre'=>$membre,
                    'groupe'=>$groupes,
                ]);
    }

    #[Route('/{id}/edit', name: 'app_groupe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Groupe $groupe, GroupeRepository $groupeRepository): Response
    {
        $form = $this->createForm(GroupeType::class, $groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $groupeRepository->add($groupe, true);

           // dd($form->getData());
            $this->addFlash('success', "Modification du ' ".$groupe-> getNomGroupe()." ' avec code ' ".$groupe->getCodegroupe()." ' reussite!!");
            return $this->redirectToRoute('app_groupe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_client/groupe/edit.html.twig', [
            'Groupe' => $groupe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_groupe_delete', methods: ['POST'])]
    public function delete(Request $request, Groupe $groupe, GroupeRepository $groupeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$groupe->getId(), $request->request->get('_token'))) {
            $groupeRepository->remove($groupe, true);
        }

        $this->addFlash('success', "Suppression du ' ".$groupe-> getNomGroupe()." ' avec code ' ".$groupe->getCodegroupe()." ' reussite!!");
        return $this->redirectToRoute('app_groupe_index', [], Response::HTTP_SEE_OTHER);
    }
}
