<?php

namespace App\Controller\Module_client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\IndividuelclientRepository;
use Symfony\Component\Routing\Annotation\Route;

class ListNoirController extends AbstractController
{
    #[Route('/list/noir', name: 'app_list_noir')]
    public function index(IndividuelclientRepository $individuelclientRepository): Response
    {
        return $this->render('Module_client/list_noir/index.html.twig', [
            'listrouge' => $individuelclientRepository->findBy(['is_list_noir'=>'1']),
        ]);
    }
}
