<?php

namespace App\Controller\Configuration;

use App\Entity\CompteCaisse;
use App\Repository\CompteCaisseRepository;
use App\Form\CompteCaisseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/Compte/Caisse')]
class CaisseController extends AbstractController
{
    #[Route('/', name: 'app_compte_caisse_index', methods: ['GET'])]
    public function index(CompteCaisseRepository $compteCaisseRepository): Response
    {
        
        return $this->render('Configuration/compte_caisse/index.html.twig', [
            'compte_caisse' => $compteCaisseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_compte_caisse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CompteCaisseRepository $compteCaisseRepository): Response
    {

        if($compteCaisseRepository->findMaxIdCaisse()){
            $id = ++$compteCaisseRepository->findMaxIdCaisse()[0][1];
        }else {
            $id = 1;
        }

        $caisse = new CompteCaisse();
        $form = $this->createForm(CompteCaisseType::class, $caisse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $codecaisse = $caisse->getPlanComptable()->getNumeroCompte()."".$caisse->getCodecaisse();
            $caisse->setCodecaisse($codecaisse);

            // Verifier si le client a de compte caisse 
            $reponsable = $caisse->getResponsable();
            $user = $compteCaisseRepository->findCaisseByUser($reponsable);

            if ($user) {
                // On nee peut pas de creer un compte caisse
                $this->addFlash('warning',"On ne peut pas creer un compte caisse car le responsable ".$caisse->getResponsable()->getNom()." ".$caisse->getResponsable()->getPrenom(). " a deja un compte  ");
            }else {
                // On peut creer un compte caissr
                $compteCaisseRepository->save($caisse, true);
                $this->addFlash('primary',"Nouveau compte caisse est ajouter : ".$caisse->getCodecaisse()." ".$caisse->getNomCaisse());
            }
            return $this->redirectToRoute('app_compte_caisse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Configuration/compte_caisse/new.html.twig', [
            'compte_caisse' => $caisse,
            'form' => $form,
            'id_max_caisse'=> $id
        ]);
    }

    #[Route('/{id}', name: 'app_compte_caisse_show', methods: ['GET'])]
    public function show(CompteCaisse $depotAterme): Response
    {
        return $this->render('Configuration/compte_caisse/show.html.twig', [
            'compte_caisse' => $depotAterme,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_compte_caisse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CompteCaisse $caisse, CompteCaisseRepository $compteCaisseRepository): Response
    {
        $form = $this->createForm(CompteCaisseType::class, $caisse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compteCaisseRepository->save($caisse, true);
            
            $this->addFlash('info',"Le compte caisse : ".$caisse->getCodecaisse()." ".$caisse->getNomCaisse()." est modifie ");
            return $this->redirectToRoute('app_compte_caisse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Configuration/compte_caisse/edit.html.twig', [
            'compte_caisse' => $caisse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_compte_caisse_delete', methods: ['POST'])]
    public function delete(Request $request, CompteCaisse $caisse, CompteCaisseRepository $compteCaisseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$caisse->getId(), $request->request->get('_token'))) {
            $compteCaisseRepository->remove($caisse, true);
        }

        return $this->redirectToRoute('app_compte_caisse_index', [], Response::HTTP_SEE_OTHER);
    }
}
