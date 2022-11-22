<?php

namespace App\Controller;

use App\Entity\Agence;
use App\Entity\CIN;
use App\Entity\Individuelclient;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;

class ExcelController extends AbstractController
{
    #[Route('/excel', name: 'app_excel')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $client=$doctrine->getRepository(Individuelclient::class)->findAll();

        $response=new StreamedResponse();
        $response->setCallback(
            function() use($client) {
                $handle=fopen('php://output','r+');
                foreach($client as $row) {
                    $data=array(
                        $row->getId(),
                        $row->getNomclient(),
                        $row->getPrenomclient(),
                        $row->getCin(),
                        $row->getAdressephysique(),
                        // $row->getDateNaissance(),
                        $row->getLieuNaissance(),
                        // $row->getDateInscription(),
                        $row->getSexe(),
                        $row->getNumeroMobile(),
                        $row->getProfession(),
                        $row->getNbEnfant(),
                        $row->getNbPersonneCharge(),
                        $row->getParentNom(),
                        $row->getParentAdresse(),
                        $row->getEtatcivile(),
                        $row->getTitre(),
                        $row->getEtude(),
                    );

                    fputcsv($handle,$data, ';', '"');
                }
                fclose($handle);

            }
        );
        $response->headers->set('Content-Type', 'application/force-download');
        $response->headers->set('Content-Disposition', 'attachment; filename="IndividuelClient.csv"');

        return $response;
    }

    #[Route('/excel/cin', name: 'app_excel_cin')]
    public function CIN(ManagerRegistry $doctrine): Response
    {
        $client=$doctrine->getRepository(Individuelclient::class)->findAll();

        $response=new StreamedResponse();
        $response->setCallback(
            function() use($client) {
                $handle=fopen('php://output','r+');
                foreach($client as $row) {
                    $data=array(
                        $row->getNomClient(),
                        $row->getPrenomClient(),
                        // $row->getDateNaissance(),
                        // $row->getLieuNaissance(),
                        $row->getCin(),
                        $row->getLieudelivrance(),
                        // $row->getDatecin(),
                        // $row->getDateexpiration(),
                    );

                    fputcsv($handle,$data, ';', '"');
                }
                fclose($handle);

            }
        );
        $response->headers->set('Content-Type', 'application/force-download');
        $response->headers->set('Content-Disposition', 'attachment; filename="CIN.csv"');

        return $response;
    }
}