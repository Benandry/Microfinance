<?php

namespace App\Controller;

use App\Repository\IndividuelclientRepository;
use Doctrine\Persistence\ManagerRegistry;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/exporter')]
class PDFController extends AbstractController
{

    //Tester exporter exccl
    #[Route('/excel', name: 'app_excel')]
    public function index(IndividuelclientRepository $repoClient): Response
    {
        $clients =$repoClient->findAll();

        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->setCellValue('A1', '#ID');
        $worksheet->setCellValue('B1', 'Nom Client');
        $worksheet->setCellValue('C1', 'Prenom Client');
        $worksheet->setCellValue('D1', 'CIN ');
        $worksheet->setCellValue('E1', "Date d'inscription ");
        $worksheet->setCellValue('F1', 'Code ');

        $row = 1;
        foreach ($clients as $client) {
            $worksheet->setCellValue('A'.$row, $client->getId());
            $worksheet->setCellValue('B'.$row, $client->getNomClient());
            $worksheet->setCellValue('C'.$row, $client->getPrenomClient());
            $worksheet->setCellValue('D'.$row, $client->getCin());
            $worksheet->setCellValue('E'.$row, $client->getDateInscription());
            $worksheet->setCellValue('F'.$row, $client->getCodeclient());
            $row++;
        }
        $writer = new Xlsx($spreadsheet);

        $filename = "IndividuelClient".date('Y').'.xlsx';
        header('Content-Type : application/vnd.openxmlformats-officedocument.spreadsheatml.sheet');
        header('Content-Disposition: attachment; filename="'.urlencode($filename).'"');
        $writer->save('php://output');

        return $this->render('pdf/index.html.twig', [
            'controller_name' => 'PDFController',
        ]);
    }
}
