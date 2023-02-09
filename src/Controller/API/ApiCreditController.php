<?php

namespace App\Controller\API;

use App\Repository\AmortissementFixeRepository;
use App\Repository\CreditIndividuelRepository;
use App\Repository\DemandeCreditRepository;
use App\Repository\RemboursementCreditRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiCreditController extends AbstractController
{
    // configuration
    /*
    *Cette method configurationCredit permet de recuperer les configuration credit
    */
    #[Route('/api/credit/{produit}', name: 'app_api_credit')]
    public function configurationCredit(CreditIndividuelRepository $creditIndividuelRepository,$produit): Response
    {
        $creditindividuel=$creditIndividuelRepository->api_configuration($produit);

        return new JsonResponse($creditindividuel);
    }
    // client
    /*
    *Cette methode est pour le client credit
    *
    */
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
    
    // Remboursement credit
    #[Route('/remboursement_credit/{codecredit}',name:'app_remboursement_credit')]
    public function RemboursementCreditApi(AmortissementFixeRepository $amortissementFixeRepository,$codecredit):Response
    {
        $remboursement=$amortissementFixeRepository->RemboursementCredit($codecredit);

        return new JsonResponse($remboursement);
    }

    /**
     * Fonction qui recupere les api remboursement selon les periodes
     */
    #[Route('/remboursement/periode/{numerocredit}/{periode}',name:'app_remboursement_periode')]
    public function ApiRemboursement(RemboursementCreditRepository $remboursementCreditRepository,string $numerocredit,int $periode):Response
    {
        $remboursement=$remboursementCreditRepository->ApiRemboursement($numerocredit,$periode);

        return new JsonResponse($remboursement);
    }


    #[Route('/credit/cycle/{codeclient}',name:'app_cycle_credit')]
    public function getCyle(DemandeCreditRepository $demandeCreditRepository,string $codeclient):Response
    {
        $cycle = $demandeCreditRepository->getCycleCredit($codeclient);
        // dd($cycle);
        return new JsonResponse($cycle);
    }
     /**
     * Fonction qui recupere les api remboursement sur le modal
     */
    #[Route('/remboursement/modal/{numerocredit}',name:'app_remboursement_periode_modal')]
    public function ApiRemboursementModal(RemboursementCreditRepository $remboursementCreditRepository,string $numerocredit):Response
    {
        $remboursement=$remboursementCreditRepository->ApiRemboursementModal($numerocredit);

        return new JsonResponse($remboursement);
    }

       /**
     * Methode permet de comparer le montant rembourser et l'echeance
     */
    #[Route('/remboursement/comparaison/{numerocredit}/{periode}',name:'app_remboursement_comparaison_modal')]
    public function ComparaisonRemboursement(RemboursementCreditRepository $remboursementCreditRepository,string $numerocredit,int $periode):Response
    {
        $comparaison=$remboursementCreditRepository->ComparaisonRemboursement($numerocredit,$periode);

        return new JsonResponse($comparaison);
    }

        /**
     * Fonction qui recupere les 1 ere remboursement en ammortissemnt
     */
    #[Route('/remboursement/ammortissement/{numerocredit}/{periode}',name:'app_remboursement_periode_ammortissement')]
    public function ApiRemboursementAmmortissemnt(RemboursementCreditRepository $remboursementCreditRepository,string $numerocredit,int $periode):Response
    {
        $remboursement=$remboursementCreditRepository->ApiRemboursementAmmortissement($numerocredit,$periode);

     
       return new JsonResponse($remboursement);
    }


}
