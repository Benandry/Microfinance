<?php

namespace App\Controller\Module_epargne;

use App\Entity\CompteEpargne;
use App\Entity\ProduitEpargne;
use App\Form\CompteEpargneType;
use App\Form\CompteGroupeEpType;
use App\Repository\AgenceRepository;
use App\Repository\CompteEpargneRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

        

#[Route('/compte/epargne')]
class CompteEpargneController extends AbstractController
{
    /**
     * Ouvrir un compte epargne client individuel
     *
     * @param Request $request
     * @param CompteEpargneRepository $compteEpargneRepository
     * @return Response
     */
    #[Route('/new', name: 'app_compte_epargne_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CompteEpargneRepository $compteEpargneRepository): Response
    {
        //Information de client
        $code = $request->query->get('code');

        /**
         * Information du client (nom,prennom,code client)
         */

        $info = $compteEpargneRepository->getInfoClient($code)[0];

        // $nom = $request->query->get('nom');
        // $prenom = $request->query->get('prenom');

        $compte_existe=$compteEpargneRepository->compteClientCourant($info['codeclient']);

        $compteEpargne = new CompteEpargne();
        $form = $this->createForm(CompteEpargneType::class, $compteEpargne);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** Verifier que le compte est deja exister ou pas */

            //verifier dans la bas e de donne si le compte est deja existeE ou pas
            $verify_compte_epargne = $compteEpargneRepository->compteEpargneVerify($compteEpargne->getCodeepargne());
            if ($verify_compte_epargne) {
                /*** On ne peut pas creer un compte epargne car le numero de compte epargne existe */
                $this->addFlash('error', "On ne peut pas creer un compte epargne car le numero ".$compteEpargne->getCodeepargne()." deja existe ");
                return $this->redirectToRoute('app_compte_epargne_new', ['code' => $code], Response::HTTP_SEE_OTHER);

                dd($verify_compte_epargne);
            }else{
                /** On peut creer un compte epargne */
                $compteEpargneRepository->add($compteEpargne, true);
                $this->addFlash('info', "Ajout de nouveau compte epargne '".$compteEpargne->getCodeepargne()."' reussite!!");
                return $this->redirectToRoute('app_compte_epargne_new', ['code' => $code], Response::HTTP_SEE_OTHER);
            }

        }
        return $this->renderForm('Module_epargne/compte_epargne/new.html.twig', [
            'compte_epargne' => $compteEpargne,
            'form' => $form,
            'comptedujours'=>$compte_existe,
            'info' => $info,
        ]);
    }

    // Compte epargne pour groupe
    #[Route('/new/groupe', name: 'app_compte_epargne_new_groupe', methods: ['GET', 'POST'])]
    public function newgroupe(Request $request, CompteEpargneRepository $compteEpargneRepository): Response
    {

        $code = $request->query->get('code');
        $nom = $request->query->get('nom');
        $email = $request->query->get('email');

        // dd($email);
        $compteEpargneExiste = $compteEpargneRepository->compteEpargneExist($code);

        // dd($compteEpargneExiste);
        $compteEpargne = new CompteEpargne();
        // dd($compteEpargne);
        $form = $this->createForm(CompteGroupeEpType::class, $compteEpargne);
        $form->handleRequest($request);
        // dd("Efa tonga ato ve");
        if ($form->isSubmitted() && $form->isValid()) {
            // dd();
            $compteEpargneRepository->add($compteEpargne, true);

            $this->addFlash('success', "Creation du compte epargne  ".$compteEpargne->getCodeepargne()." réussite!!!");
            return $this->redirectToRoute('app_compte_epargne_new_groupe', [
                'code' => $code,
                'nom' => $nom,
                'prenom' => $email,
            ], Response::HTTP_SEE_OTHER);
        }
       
        return $this->renderForm('Module_epargne/compte_epargne/newcomptegroupe.html.twig', [
            'compte_epargne' => $compteEpargne,
            'compte_exist' =>$compteEpargneExiste,
            'form' => $form,
            'code'=>$code,
            'nom' =>$nom,
            'email'=>$email

        ]);
    }

    // Show individuel
    #[Route('/{id}', name: 'app_compte_epargne_show', methods: ['GET'])]
    public function show(CompteEpargneRepository $compteEpargneRepository,$id,AgenceRepository $agence,CompteEpargne $epargne): Response
    {

        $client=$compteEpargneRepository->clientCompteEpargne($id);
        // dd($client); 
        return $this->render('Module_epargne/compte_epargne/show.html.twig', [
            'clients' => $client,
            'epargnes' => $epargne,
        ]);
    }

    // Details groupe
    #[Route('/DetailesGroupe/{id}', name: 'app_compte_epargne_details_groupe', methods: ['GET'])]
    public function DetailsGroupe(CompteEpargneRepository $compteEpargneRepository,ManagerRegistry $doctrine,$id,AgenceRepository $agence): Response
    {
       // $epargne=$doctrine->getRepository(CompteEpargne::class)->find($id);
        $Groupe=$compteEpargneRepository->findyGroupeById($id);
        $agenceRepos=$agence->findAll();

        return $this->render('Module_epargne/compte_epargne/showgroupe.html.twig', [
            'Groupes' => $Groupe,
            'agences'=>$agenceRepos,
        ]);
    }


    #[Route('/{id}/edit', name: 'app_compte_epargne_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CompteEpargne $compteEpargne, CompteEpargneRepository $compteEpargneRepository): Response
    {
        $form = $this->createForm(CompteEpargneType::class, $compteEpargne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compteEpargneRepository->add($compteEpargne, true);

            $this->addFlash('success', "Modification compte epargne '".$compteEpargne->getCodeepargne()."' reussite!!");
            return $this->redirectToRoute('app_compte_epargne_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_epargne/compte_epargne/edit.html.twig', [
            'compte_epargne' => $compteEpargne,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_compte_epargne_delete', methods: ['POST'])]
    public function delete(Request $request, CompteEpargne $compteEpargne, CompteEpargneRepository $compteEpargneRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compteEpargne->getId(), $request->request->get('_token'))) {
          #  dd($compteEpargne);
            $compteEpargneRepository->remove($compteEpargne, true);
        }

        return $this->redirectToRoute('app_compte_epargne_index', [], Response::HTTP_SEE_OTHER);
    }

    // Solde
    #[Route('/solde/{id}', name: 'app_solde')]
    public function Solde(ManagerRegistry $doctrine,$id,AgenceRepository $agence): Response
    { 
        $compte=$doctrine->getRepository(CompteEpargne::class)->find($id);
        $client=$compte->getCodeclient();
        $produit=$compte->getProduit();

                // Agence
                $agenceRepos=$agence->findAll();

                // type produit
                $produits=$doctrine->getRepository(ProduitEpargne::class)->find($id);
                $type=$produit->getTypeEpargne();        

        return $this->render('Module_epargne/compte_epargne/solde.html.twig',[
            'comptes'=>$compte,
            'clients'=>$client,
            'produits'=>$produit,
            'types'=>$type,
            'agences'=>$agenceRepos
            ]
            );
    }      
}
