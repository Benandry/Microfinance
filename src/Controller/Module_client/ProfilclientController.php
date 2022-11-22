<?php

namespace App\Controller\Module_client;

use App\Entity\Individuelclient;
use App\Repository\IndividuelclientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilclientController extends AbstractController
{
    #[Route('/profilclient', name: 'app_profilclient')]
    public function index(IndividuelclientRepository $individuelclient): Response
    {
        return $this->render('', [
            'individuelclient' => 'ProfilclientController',
        ]);
    }
}
