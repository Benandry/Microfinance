<?php

namespace App\Controller\API;

use App\Repository\CreditIndividuelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiCreditController extends AbstractController
{
    #[Route('/api/credit/{produit}', name: 'app_api_credit')]
    public function configurationCredit(CreditIndividuelRepository $creditIndividuelRepository,$produit): Response
    {
        $creditindividuel=$creditIndividuelRepository->api_configuration($produit);

        return new JsonResponse($creditindividuel);
    }
}
