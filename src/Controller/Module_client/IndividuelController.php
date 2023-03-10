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
use Doctrine\ORM\EntityManagerInterface;
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


#[Route('/individuel')]
class IndividuelController extends AbstractController
{
    #[Route('/', name: 'app_individuel_index')]
    public function index(Request $request,IndividuelclientRepository $individuelclientRepository,AgenceRepository $agenceRepository): Response
    {

        $individuel=$individuelclientRepository->findBy([],['id' => 'ASC' ]);


        return $this->renderForm('Module_client/individuel/index.html.twig', [
            'individuelclients' => $individuel,
            'agences' => $agenceRepository->findAll(),
        ]);
    }
    
    #[Route('/new', name: 'app_individuel_new', methods: ['GET', 'POST'])]

    public function new(Request $request, IndividuelclientRepository $individuelclientRepository,FileUploader $fileUploader,EntityManagerInterface $entityManagerInterface): Response
    {
        $get_last_client = $individuelclientRepository->findByLastClient();

        #dd($get_last_client[0][1]);
        if ($get_last_client[0][1]== NULL ) {
            $lastClient = 0;
        }else{
            $lastClient = $get_last_client[0][1];
        }
        
        ///MAKA an ilay id agence ///

        $get_id_agence = $individuelclientRepository->findByAgenceCode();
    //    dd($get_id_agence);
        if ($get_id_agence == NULL ) {
            $agence_client = 0;
        }else{
            $agence_client = $get_id_agence[0]['id'];
        }


        $individuelclient = new Individuelclient();
        #dd($individuelclient);
        $form = $this->createForm(IndividuelclientType::class, $individuelclient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('photo')->getData();
            if ($brochureFile) {
                $brochureFileName = $fileUploader->upload($brochureFile);
                $individuelclient->setPhoto($brochureFileName);
            }

            //Get le numero de cin de nouveau client et verifier s'il existe ou pas
            $numero_cin = $individuelclient->getCin();
            $cin_client = $individuelclientRepository->findByNumeroCin($numero_cin);

            if($cin_client){
                //Client deja existe
                $this->addFlash("error","Ajout de nouveau client:  ' ".$individuelclient-> getNomClient()."  " . $individuelclient->getPrenomClient()."  est impossible car son numero de cin ' ".$numero_cin." ' est deja existe dans la base de donnee !!");
                return $this->redirectToRoute('app_individuel_new', [], Response::HTTP_SEE_OTHER);
            }else{
                // Le nouveau client n'existe pas dans la base et on peut ajouter
                $individuelclientRepository->add($individuelclient,True);
                $this->addFlash('success', "Ajout de nouveau client:  ' ".$individuelclient-> getNomClient()."  " . $individuelclient->getPrenomClient()." ' avec code ".$individuelclient->getCodeclient()."  reussite!!");
                return $this->redirectToRoute('app_individuel_new', [], Response::HTTP_SEE_OTHER);
            }
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
    public function show(Individuelclient $client ): Response
    {
        // dd($client);
        $writer = new PngWriter();
        $qrCode = QrCode::create("
                Code : ".$client->getCodeclient()." \n
                Nom :".$client->getNomClient()."\n
                Prenom : ".$client->getPrenomClient()."\n
                Numero CIN : ". $client->getCin()."\n
                Adresse : ".$client->getAdressephysique()."\n
                Tel : ".$client->getNumeroMobile())
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(120)
            ->setMargin(0)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        $label = Label::create('')->setFont(new NotoSans(8));
        $qrCodes['simple'] = $writer->write($qrCode,null,$label->setText('Individuel-client'))->getDataUri();
        // dd($qrCodes);
        return $this->render('Module_client/individuel/show.html.twig', [
            'individuelclient'=> $client,
            'qr_code' => $qrCodes['simple']
        ]);
    }

#[Route('/{id}/edit/{active}', name: 'app_individuel_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Individuelclient $individuelclient, IndividuelclientRepository $individuelclientRepository,FileUploader $fileUploader,EntityManagerInterface $entityManagerInterface,$id ,$active): Response
    {

        $form = $this->createForm(IndividuelclientType::class, $individuelclient);
        $form->handleRequest($request);
        
        //dd($active);

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
            'active' => $active,
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
