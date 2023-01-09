<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitEpargneRepository;
use App\Repository\CompteEpargneRepository; 
use App\Repository\TransactionRepository;
use App\Repository\CommuneRepository;
use App\Repository\GroupeRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class AllApiController extends AbstractController
{
    #[Route('/api/individuel/{id}', name: 'app_api_individuel')]
    public function index(ProduitEpargneRepository $produitRepo,$id): Response
    {

        $api = $produitRepo->findByApiProduit($id); 

        // dd($api);
        return new JsonResponse($api);
    }

    #[Route('/api/transaction/{code}', name: 'app_api_transaction')]

    public function api_transaction(TransactionRepository $transactionRepository,$code): Response
    {

        $api = $transactionRepository->api_transaction($code); 

        return new JsonResponse($api);
    }

    #[Route('/api/releve/{codeepargne}', name: 'app_api_releve')]

    public function api_releve(TransactionRepository $transactionRepository,$codeepargne): Response
    {

        $api = $transactionRepository->api_releve_transac($codeepargne); 

        return new JsonResponse($api);
    }


    #[Route('/api/transfert/{codeclient}', name: 'app_api_transfert')]

    public function api_transferts(TransactionRepository $transactionRepository,$code): Response
    {

        $api = $transactionRepository->api_transaction($code); 

        return new JsonResponse($api);
    }

    #[Route('/api/commune-madagascar', name: 'api_commune')]

    public function api_commune(CommuneRepository $transactionRepository): Response
    {

        $api = $transactionRepository->api_commune(); 

        return new JsonResponse($api);
    }


    #[Route('/api/code-client/{code}', name: 'app_api_code_client')]

    public function api_code_client(ProduitEpargneRepository $repo,$code): Response
    {

        $api = $repo->code_client_api($code); 

        return new JsonResponse($api);
    }

    #[Route('/api/code-client', name: 'app_code_client')]

    public function code_client(ProduitEpargneRepository $repo): Response
    {

        $api = $repo->code_client(); 

        return new JsonResponse($api);
    }


    #[Route('/api/code-epargne', name: 'app_code_epargne')]

    public function code_epargne(ProduitEpargneRepository $repo): Response
    {

        $api = $repo->code_epargne(); 

        return new JsonResponse($api);
    }

    //Api tranfert
    #[Route('/api/transfert/{codeepargne}', name: 'app_api_transfert')]

    public function api_transfert(TransactionRepository $transactionRepository,$codeepargne): Response
    {

        $api = $transactionRepository->api_transfert($codeepargne); 

        return new JsonResponse($api);
    }


    /*********************Api code groupe */
    #[Route('/api/code-groupe', name: 'app_code_groupe')]

    public function code_groupe(GroupeRepository $repo): Response
    {

        $api = $repo->code_groupe(); 

        return new JsonResponse($api);
    }

    #[Route('/api/code-groupe/code/{code}', name: 'app_code_groupe_code')]

    public function api_code_groupe(GroupeRepository $repo,$code): Response
    {

        $api = $repo->code_groupe_api($code); 

        return new JsonResponse($api);
    }

    #######API code epargne ================================

    #[Route('/api/epargne', name: 'code_compte_eprgne')]

    public function api_compte_epargne(CompteEpargneRepository $repo): Response
    {

        $api = $repo->codeCompteEpargne(); 
        return new JsonResponse($api);
    }


    #[Route('/info/{code}', name: 'code_compte_eprgne_nom_et_prenom')]

    public function api_compte_epargne_client(CompteEpargneRepository $repo,$code): Response
    {

        $api = $repo->codeCompteEpargneInfo($code); 
        return new JsonResponse($api);
    }


    #[Route('/releve/client/{code}', name: 'relever_recherche_cli')]
    public  function rechercheReleveClientFunc(TransactionRepository $repo,$code)
    {
        $api= $repo->rechercheReleveClient($code);
       // dd($api);
        return new JsonResponse($api);
    }


    #[Route('/api/allcodegroupe', name: 'app_all_code_groupe')]

    public function api_code_groupe_epargne(GroupeRepository $repo): Response
    {

        $api = $repo->api_compte_epargne_groupe(); 

        return new JsonResponse($api);
    }

    #[Route('/api/epargne/groupe/{code}', name: 'app_code_groupe_epargne')]

    public function api_code_groupe_epargne_by_id(GroupeRepository $repo,$code): Response
    {
        $api = $repo->api_compte_epargne_groupe_code($code); 

        return new JsonResponse($api);
    }

}