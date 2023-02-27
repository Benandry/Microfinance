<?php

namespace App\Controller\Module_client;

use App\Entity\Patrimoine;
use App\Form\PatrimoineType;
use App\Repository\PatrimoineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatrimoineController extends AbstractController
{
    /**
     * Undocumented function
     * @method mixed Patrimoine(): Methode permet d'enregistrer les patrimoines des clients
     * @param Request $request
     * @param PatrimoineRepository $PatrimoineRepository
     * @return void
     */
    #[Route('/Patrimoineindividuel/patr',name:'app_individuelpatrimoine')]
    public function Patrimoine(EntityManagerInterface $emi,PatrimoineRepository $PatrimoineRepository,Request $request):Response
    {
        $idclient=$request->query->get('nom');

        $patrimoineindividuel=new Patrimoine();

        // $information_client = $PatrimoineRepository->Patrimoine($idclient);

        $patrimoineind=$PatrimoineRepository->Patrimoine($idclient)[0];
        

        $form = $this->createForm(PatrimoineType::class,$patrimoineindividuel);
        $form->handleRequest($request);

        // dd($form);

        if ($form->isSubmitted() && $form->isValid()) {

            
            $codeclient=$patrimoineind->getCodeclient();
            $patrimoineindividuel->setIdClient($codeclient);

            /**
             * Somme des montant des patrimoines
             */

            $montant1=$patrimoineindividuel->getMontant1();
            $montant2=$patrimoineindividuel->getMontant2();
            $montant3=$patrimoineindividuel->getMontant3();
            $montant4=$patrimoineindividuel->getMontant4();

            /**
             * Setter ds somme des patrimoine
             */
            $patrimoineindividuel->setTotalPatrimoine($montant1+$montant2+$montant3+$montant4);
            
            // $PatrimoineRepository->add($patrimoineindividuel, true);

            $emi->persist($patrimoineindividuel);
            $emi->flush();

            $this->addFlash('success', 'La patrimoine de'.$patrimoineind-> getNomClient()." ".$patrimoineind->getPrenomClient()." est bien ajoutés");
            return $this->redirectToRoute('app_individuelpatrimoine', ['nom' => $idclient], Response::HTTP_SEE_OTHER);
        }
        // dd($patrimoineind);
        return $this->renderForm('Module_client/individuel/Patrimoine.html.twig', [
            'form' => $form,
            'idclient'=>$idclient,
            'info' => $patrimoineind,
        ]); 
    }

    /**
     * Undocumented function
     *
     * @method mixed ListePatrimoine():Permet de lister les patrimoines
     * @param PatrimoineRepository $PatrimoineRepository
     * @param [type] $codeclient
     * @return array
     */
    #[Route('/Liste/Patrimoine/',name:'app_liste_patrimoine')]
    public function ListePatrimoine(PatrimoineRepository $PatrimoineRepository)
    {
        $liste=$PatrimoineRepository->ListePatrimoine();

        // dd($liste);

        return $this->render('Module_client/individuel/ListePatrimoine.html.twig',
            [
                'liste'=>$liste,
            ]); 

    }

}