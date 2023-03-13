<?php

namespace App\Controller\API;

use App\Repository\AmortissementFixeRepository;
use App\Repository\ConfigurationCreditRepository;
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
    #[Route('api/demandecredit/{compteepargne}',name:'app_demende_credit')]
    public function DemandeCredit(CreditIndividuelRepository $creditIndividuelRepository,$compteepargne):Response
    {
        $demandecredit=$creditIndividuelRepository->api_demandecredit($compteepargne);
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
    #[Route('/remboursement/modal/{numerocredit}',name:'app_modalremb')]
    public function ApiRemboursementModal(RemboursementCreditRepository $remboursementCreditRepository,$numerocredit):Response
    {
        $remboursement=$remboursementCreditRepository->ApiRemboursementModal($numerocredit);

        return new JsonResponse($remboursement);
    }

      /**
     * Fonction qui recupere les api remboursement sur le modal
     */
    #[Route('/sommeremboursement/somme/{numerocredit}',name:'app_sommecredit')]
    public function SommeCredit(RemboursementCreditRepository $remboursementCreditRepository,$numerocredit):Response
    {
        $somme=$remboursementCreditRepository->CreditSomme($numerocredit);

        return new JsonResponse($somme);
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
    /**
     * @method mixed ConfigurationDemande():on recupere ici la liste des configurations 
     * afin qu'on puisse utilise dans le demande
     * 
     * @param mixed $produitcredit : produit credit
     */
    #[Route('/demandecredit/credit/{produitcredit}',name:'app_configuration_demande')]
    public function ConfigurationDemande(ConfigurationCreditRepository $configurationCreditRepository,$produitcredit):Response
    {
        $remboursement=$configurationCreditRepository->ConfigurationCredit($produitcredit);

     
       return new JsonResponse($remboursement);
    }

    /**
     * @method mixed InfoClientDemandeCredit() : Cette methode permet de connaitre l'information concernant
     * le client qui fait le demande
     * @param mixed $codeclient : parametre qui recupere le code individuel ou groupe
     */
    #[Route('/infodemande/credit/individuel/{codeclient}',name:'app_info_demande_credit_individuel')]
    public function InformationClientDemandeCreditIndividuel(DemandeCreditRepository $demandeCreditRepository,$codeclient):Response
    {
        $infodemandeindividuel=$demandeCreditRepository->InfoClientDemandeCreditIndividuel($codeclient);

        return new JsonResponse($infodemandeindividuel);
    }
    
    /**
     * @method mixed DemandeCreditModal():Afficher les informations individuel
     * @param mixed $demandecreditrepository
     * @param mixed $id
     */
    #[Route('/modaldemandecredit/{id}',name:'app_modal_demande_credit')]
    public function DemandeCreditModalIndividuel(DemandeCreditRepository $demandeCreditRepository,$id):Response
    {
        $modaldemandecredit=$demandeCreditRepository->InfoDemandeCreditModal($id);

        return new JsonResponse($modaldemandecredit);
    }

    #[Route('/demandecreditinfogroupe/{id}',name:'app_demandecredit_groupe')]
    public function DemandeCreditModalGroupe(DemandeCreditRepository $demandeCreditRepository,$id)
    {
        $modaldemandecreditgroupe=$demandeCreditRepository->InfoDemandeCreditGroupe($id);

        return new JsonResponse($modaldemandecreditgroupe);
    }

    /**
     * Undocumented function
     *@method mixed InformationClientDemandeCreditGroupe() : Mehode permet de connaitre l'information 
     *groupe
     *@param mixed $codegroupe:code client groupe
     * @return json
     */
    #[Route('/infodemandecredit/groupe/{codegroupe}',name:'app_groupe_info')]
    public function InformationClientDemandeCreditGroupe(DemandeCreditRepository $demandeCreditRepository,$codegroupe):Response
    {
        $infodemandegroupe=$demandeCreditRepository->InfoClientDemandeCreditGroupe($codegroupe);

        return new JsonResponse($infodemandegroupe);
    }

       /**
     * Undocumented function
     *@method mixed InformationClientDemandeCreditGroupe() : Mehode permet de connaitre l'information 
     *groupe
     *@param mixed $codegroupe:code client groupe
     * @return json
     */
    #[Route('/modalindividuel/{NumeroCredit}',name:'app_imodal')]
    public function InformationModalIndividuel(DemandeCreditRepository $demandeCreditRepository,$NumeroCredit):Response
    {
        $infodemandegroupe=$demandeCreditRepository->InfoClientModalIndividuel($NumeroCredit);

        return new JsonResponse($infodemandegroupe);
    }

          /**
     * Undocumented function
     *@method mixed InformationClientDemandeCreditGroupe() : Mehode permet de connaitre l'information 
     *groupe
     *@param mixed $codegroupe:code client groupe
     * @return json
     */
    #[Route('/groupemodal/{NumeroCredit}',name:'app_modalg')]
    public function InfoClientModalGroupe(DemandeCreditRepository $demandeCreditRepository,$NumeroCredit):Response
    {
        $infodemandegroupe=$demandeCreditRepository->InfoClientModalGroupe($NumeroCredit);

        return new JsonResponse($infodemandegroupe);
    }


    /**
     * @method mixed InformationGarant():Fonction permet de recuperer le liste des garants
     * @param mixed $codeclient
     * @return  json
     */
    #[Route('/infogarant/individuelclient/{codeclient}',name:'app_info_garant')]
    public function InformationGarant(DemandeCreditRepository $demandeCreditRepository,$codeclient):Response
    {
        $garant=$demandeCreditRepository->InfoGarant($codeclient);

        return new JsonResponse($garant);
    }


}
