<?php

namespace App\Controller\Module_client;

use App\Entity\Individuelclient;
use App\Form\IndividuelclientType;
use App\Repository\IndividuelclientRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GarantController extends AbstractController
{
    /**
     * Undocumented function
     * @method mixed Garant(): Methode permet de changer le client individuel en garant
     * @param mixed $name
     * @param Request $request
     * @return void
     */
    #[Route('/Garant/individuel/',name:'app_garant')]
    public function Garant(FileUploader $fileUploader,IndividuelclientRepository $individuelclientRepository,Request $request):Response
    {
        // dd($individuelclientRepository);
        $idclient=$request->query->get('nom');

        $client=$individuelclientRepository->profil($idclient)[0];

        // dd($client);

        $form = $this->createForm(IndividuelclientType::class,$client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $brochureFile = $form->get('photo')->getData();
            if ($brochureFile) {
                $brochureFileName = $fileUploader->upload($brochureFile);
                $client->setPhoto($brochureFileName);
            }

    
            $individuelclientRepository->add($client, true);

            $this->addFlash('success', $client-> getNomClient()." ".$client->getPrenomClient()." est devenu garant");

        }

        return $this->renderForm('Module_client/individuel/AjoutGarant.html.twig', [
            'form' => $form,
        ]);

        
    }

    /**
     * Undocumented function
     *@method mixed ListeGarant():
     * @param IndividuelclientRepository $individuelclientRepository
     * @return void
    */

    #[Route('/listegarant/liste/',name:'app_listegarant')]
    public function ListeGarant(IndividuelclientRepository $individuelclientRepository):Response
    {   
        $listegarant=$individuelclientRepository->ListeGarant();

        // return new JsonResponse($listegarant);

        return $this->render('Module_client/individuel/ListeGarant.html.twig',[
            'listegarant'=>$listegarant,
        ]
    );
    }

}