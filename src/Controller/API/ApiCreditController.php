<?php

namespace App\Controller\API;

use App\Repository\CreditIndividuelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiCreditController extends AbstractController
{
    // configuration
    #[Route('/api/credit/{produit}', name: 'app_api_credit')]
    public function configurationCredit(CreditIndividuelRepository $creditIndividuelRepository,$produit): Response
    {
        $creditindividuel=$creditIndividuelRepository->api_configuration($produit);

        return new JsonResponse($creditindividuel);
    }
    // client
    #[Route('/api/credit/client/{codeclient}',name:'app_api_credit_client')]
    public function clientcredit(CreditIndividuelRepository $creditIndividuelRepository,$codeclient):Response
    {
        $creditIndividue=$creditIndividuelRepository->api_client_individuel($codeclient);

        return new JsonResponse($creditIndividue);
    }
    // Demande credit 
    /*
    *ici on verifie si le client est deja emprunté
    */ 
    #[Route('api/credit/{codeclient}',name:'app_demende_credit')]
    public function DemandeCredit(CreditIndividuelRepository $creditIndividuelRepository,$codeclient):Response
    {
        $demandecredit=$creditIndividuelRepository->api_demandecredit($codeclient);
        return new JsonResponse($demandecredit);
    }
}
