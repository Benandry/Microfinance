<?php

namespace App\Controller\Module_epargne;

use App\Entity\CompteEpargne;
use App\Entity\ProduitEpargne;
use App\Form\CompteEpargneType;
use App\Form\CompteGroupeEpType;
use App\Repository\AgenceRepository;
use App\Repository\CompteEpargneRepository;
use Doctrine\Persistence\ManagerRegistry;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/compte/epargne')]
class CompteEpargneController extends AbstractController
{
    /**
     * Ouverture d'un compte epargne client individuel
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
        if ($request->query->get('status')) {
            $status = $request->query->get('status');
        }else {
            $status = null;
        }

        /**
         * Information du client (nom,prennom,code client)
         */
        $info = $compteEpargneRepository->getInfoClient($code)[0];
        $year_client = date("Y") - $info['date_naissance']->format('Y');

        $compte_existe=$compteEpargneRepository->compteClientCourant($info['codeclient']);

        $compteEpargne = new CompteEpargne();
        $form = $this->createForm(CompteEpargneType::class, $compteEpargne);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // dd()
            /** Verifier que le compte est deja exister ou pas */
            //verifier dans la bas e de donne si le compte est deja existeE ou pas
            $verify_compte_epargne = $compteEpargneRepository->compteEpargneVerify($compteEpargne->getCodeepargne());
            if ($verify_compte_epargne) {
                /*** On ne peut pas creer un compte epargne car le numero de compte epargne existe */
                $this->addFlash('danger', "On ne peut pas creer un compte epargne car le numero ".$compteEpargne->getCodeepargne()." deja existe ");
                return $this->redirectToRoute('app_compte_epargne_new', ['code' => $code], Response::HTTP_SEE_OTHER);

                // dd($verify_compte_epargne);
            }else{
                /** On peut creer un compte epargne */
                $compteEpargneRepository->add($compteEpargne, true);
                $this->addFlash('primary', "Ajout de nouveau compte epargne '".$compteEpargne->getCodeepargne()."' reussite!!");
                return $this->redirectToRoute('app_compte_epargne_new', ['code' => $code], Response::HTTP_SEE_OTHER);
            }

        }
        return $this->renderForm('Module_epargne/compte_epargne/new.html.twig', [
            'compte_epargne' => $compteEpargne,
            'form' => $form,
            'comptedujours'=>$compte_existe,
            'info' => $info,
            'year_client' => $year_client,
            'code' => $code,
            'status' => $status
        ]);
    }



    /**
     * Ouverture d'un Compte epargne pour groupe
     *
     * @param Request $request
     * @param CompteEpargneRepository $compteEpargneRepository
     * @return Response
     */
    #[Route('/new/groupe', name: 'app_compte_epargne_new_groupe', methods: ['GET', 'POST'])]
    public function newgroupe(Request $request, CompteEpargneRepository $compteEpargneRepository): Response
    {

        $id = $request->query->get('code');

        if ($request->query->get('status')) {
            $status = $request->query->get('status');
        }else {
            $status = null;
        }

        $info_groupe = $compteEpargneRepository->getInfoGroupe($id)[0];

        $compteEpargneExiste = $compteEpargneRepository->compteEpargneExist($info_groupe['codegroupe']);

        // dd($compteEpargneExiste);
        $compteEpargne = new CompteEpargne();
        // dd($compteEpargne);
        $form = $this->createForm(CompteGroupeEpType::class, $compteEpargne);
        $form->handleRequest($request);
        // dd("Efa tonga ato ve");
        if ($form->isSubmitted() && $form->isValid()) {
            // dd($compteEpargne);
            //Verifier le compte epargne groupe s'il est deja exister
            $verify_compte_epargne = $compteEpargneRepository->compteEpargneVerify($compteEpargne->getCodeepargne());
            if ($verify_compte_epargne) {
                /*** On ne peut pas creer un compte epargne car le numero de compte epargne existe */
                $this->addFlash('danger', "On ne peut pas creer un compte epargne car le numero ".$compteEpargne->getCodeepargne()." deja existe ");
                return $this->redirectToRoute('app_compte_epargne_new_groupe', ['code' => $id], Response::HTTP_SEE_OTHER);

            }else{
                /** On peut creer un compte epargne */
                $compteEpargneRepository->add($compteEpargne, true);
                $this->addFlash('primary', "Ajout de nouveau compte epargne '".$compteEpargne->getCodeepargne()."' reussite!!");
                return $this->redirectToRoute('app_compte_epargne_new_groupe', ['code' => $id], Response::HTTP_SEE_OTHER);
            }
            
            $compteEpargneRepository->add($compteEpargne, true);
            $this->addFlash('success', "Creation du compte epargne  ".$compteEpargne->getCodeepargne()." réussite!!!");
            return $this->redirectToRoute('app_compte_epargne_new_groupe', ['code' => $id,], Response::HTTP_SEE_OTHER);
        }
       
        return $this->renderForm('Module_epargne/compte_epargne/newcomptegroupe.html.twig', [
            'compte_epargne' => $compteEpargne,
            'compte_exist' =>$compteEpargneExiste,
            'form' => $form,
            'info'=>$info_groupe,
            'code' => $id,
            'status' => $status
        ]);
    }



    // Show individuel
    #[Route('/{id}', name: 'app_compte_epargne_show', methods: ['GET'])]
    public function show(CompteEpargneRepository $compteEpargneRepository,$id,AgenceRepository $agence,CompteEpargne $epargne): Response
    {


        $clients=$compteEpargneRepository->clientCompteEpargne($id);
        $client = $clients[0] ; 
        $solde = $client['solde'] === null ? 0 : $client['solde'];
        $writer = new PngWriter();
        $qrCode = QrCode::create("
                Compte epargne : ".$epargne->getCodeepargne()." \n
                Nom : ".$client['nom_client']."\n
                Prenom : ".$client['prenom_client']."\n
                Produit Epargne : ". $client['nomproduit']."\n
                Solde : ".$solde." Ariary "
                )
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(120)
            ->setMargin(0)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        $label = Label::create('')->setFont(new NotoSans(8));
        $qrCodes['simple'] = $writer->write($qrCode,null,$label->setText('compteEpargne-client'))->getDataUri();


        return $this->render('Module_epargne/compte_epargne/show.html.twig', [
            'clients' => $clients,
            'epargnes' => $epargne,
            'qr_code' => $qrCodes['simple']
        ]);
    }

    // Details groupe
    #[Route('/DetailesGroupe/{id}', name: 'app_compte_epargne_details_groupe', methods: ['GET'])]
    public function DetailsGroupe(CompteEpargneRepository $compteEpargneRepository,ManagerRegistry $doctrine,$id,AgenceRepository $agence): Response
    {
       // $epargne=$doctrine->getRepository(CompteEpargne::class)->find($id);
        $Groupe=$compteEpargneRepository->findyGroupeById($id);
        $agenceRepos=$agence->findAll();
        // dd($agenceRepos);
        return $this->render('Module_epargne/compte_epargne/showgroupe.html.twig', [
            'Groupes' => $Groupe,
            'agences'=>$agenceRepos,
        ]);
    }


    /**
     * Modification du compte epargne
     */
    #[Route('/{id}/edit/{code}', name: 'app_compte_epargne_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CompteEpargne $compteEpargne, CompteEpargneRepository $compteEpargneRepository,$code): Response
    {
        $form = $this->createForm(CompteEpargneType::class, $compteEpargne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // dd($compteEpargne);

            $this->addFlash('success', "Modification compte epargne '".$compteEpargne->getCodeepargne()."' reussite!!");
            $compteEpargneRepository->add($compteEpargne, true);
            return $this->redirectToRoute('app_compte_epargne_new', ['code' => $code], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_epargne/compte_epargne/edit.html.twig', [
            'compte_epargne' => $compteEpargne,
            'form' => $form,
        ]);
    }


    /**
     * Activation du compte epargne
     * 
     */
    #[Route('/{id}/activated/{code}', name: 'app_compte_epargne_activated', methods: ['GET', 'POST'])]
    public function activated(Request $request, CompteEpargne $compteEpargne, CompteEpargneRepository $compteEpargneRepository,$code): Response
    {
        $form = $this->createForm(CompteEpargneType::class, $compteEpargne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('primary', "Le compte epargne '".$compteEpargne->getCodeepargne()."' est Activer!!");
            $compteEpargneRepository->add($compteEpargne, true);
            return $this->redirectToRoute('app_compte_epargne_new', ['code' => $code], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_epargne/compte_epargne/activated.html.twig', [
            'compte_epargne' => $compteEpargne,
            'form' => $form,
        ]);
    }


    #[Route('/{id}/editgroupe/{code}', name: 'app_compte_epargne_edit_groupe', methods: ['GET', 'POST'])]
    public function editGroupe(Request $request, CompteEpargne $compteEpargne, CompteEpargneRepository $compteEpargneRepository,$code): Response
    {
        $form = $this->createForm(CompteEpargneType::class, $compteEpargne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $compteEpargne->setTypeClient("GROUPE");
                $compteEpargneRepository->add($compteEpargne, true);
                $this->addFlash('success', "Modification compte epargne '".$compteEpargne->getCodeepargne()."' reussite!!");
                return $this->redirectToRoute('app_compte_epargne_new_groupe', ['code' => $code], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_epargne/compte_epargne/edit.html.twig', [
            'compte_epargne' => $compteEpargne,
            'form' => $form,
        ]);
    }


    /**
     * Activation du compte epargne groupe
     * 
     */
    #[Route('/{id}/activated_groupe/{code}', name: 'app_compte_epargne_activated_groupe', methods: ['GET', 'POST'])]
    public function activated_groupe(Request $request, CompteEpargne $compteEpargne, CompteEpargneRepository $compteEpargneRepository,$code): Response
    {
        $form = $this->createForm(CompteEpargneType::class, $compteEpargne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('primary', "Le compte epargne '".$compteEpargne->getCodeepargne()."' est Activer!!");
            $compteEpargneRepository->add($compteEpargne, true);
            return $this->redirectToRoute('app_compte_epargne_new_groupe', ['code' => $code], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_epargne/compte_epargne/activated.html.twig', [
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
