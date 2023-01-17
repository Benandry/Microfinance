<?php

namespace App\Controller;

use PDFExcel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/exporter')]
class PDFController extends AbstractController
{

    //Tester exporter exccl
    #[Route('/excel', name: 'app_p_d_f')]
    public function index(): Response
    {
    
        // Créez un nouveau fichier Excel
        // e);
        
        return $this->render('pdf/index.html.twig', [
            'controller_name' => 'PDFController',
        ]);
    }
}
