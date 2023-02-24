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
    #[Route('/Patrimoineindividuel/patr/',name:'app_individuelpatrimoine')]
    public function Patrimoine(EntityManagerInterface $emi,PatrimoineRepository $PatrimoineRepository,Request $request):Response
    {
        $idclient=$request->query->get('nom');

        $patrimoineindividuel=new Patrimoine();

        $patrimoineind=$PatrimoineRepository->Patrimoine($idclient)[0];
        

        $form = $this->createForm(PatrimoineType::class,$patrimoineindividuel);
        $form->handleRequest($request);

        // dd($form);

        if ($form->isSubmitted() && $form->isValid()) {

            
            $codeclient=$patrimoineind->getCodeclient();
            $patrimoineindividuel->setIdClient($codeclient);
            
            // $PatrimoineRepository->add($patrimoineindividuel, true);

            $emi->persist($patrimoineindividuel);
            $emi->flush();

            $this->addFlash('success', 'La patrimoine de'.$patrimoineind-> getNomClient()." ".$patrimoineind->getPrenomClient()." est bien ajoutés");

        }

        return $this->renderForm('Module_client/individuel/Patrimoine.html.twig', [
            'form' => $form,
        ]);

        
    }

}