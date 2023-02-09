<?php

namespace App\Controller\Module_client;

use App\Entity\Individuelclient;
use App\Repository\IndividuelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TriController extends AbstractController
{
    #[Route('/tri', name: 'app_tri')]
    public function index(): Response
    {
        return $this->render('tri/index.html.twig', [
            'controller_name' => 'TriController',
        ]);
    }
    #[Route('/ajout',name:'ajout_tri')]
    public function Ajout(Request $request,IndividuelRepository $IndividuelRepository){
        $IndividuelRepository=new Individuelclient();
        $form=$this->createForm(Individuelclient::class,$IndividuelRepository);
        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                
            }
    }
}
