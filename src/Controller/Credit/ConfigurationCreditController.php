<?php

namespace App\Controller\Credit;

use App\Entity\ConfigurationCredit;
use App\Form\ConfigurationCreditType;
use App\Repository\ConfigurationCreditRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/configuration/credit')]
class ConfigurationCreditController extends AbstractController
{
    #[Route('/',name:'app_liste_produit_configure')]
    public function ListeProduitConfigure(ConfigurationCreditRepository $configurationCreditRepository)
    {
        $configuration_credit=$configurationCreditRepository->ListeProduitConfigure();

        return $this->render('configuration_credit/index.html.twig', [
            'configuration_credits' => $configuration_credit,
        ]);

    }

    #[Route('/new', name: 'app_configuration_credit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ConfigurationCreditRepository $configurationCreditRepository): Response
    {
        $produit=$request->query->get('ProduitCredit');
        // dd($produit);

        $configurationCredit = new ConfigurationCredit();
        $form = $this->createForm(ConfigurationCreditType::class, $configurationCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $configurationCredit->setIdProduit($produit);
            
            $configurationCreditRepository->save($configurationCredit, true);

            $this->addFlash('success', 'Configuration du produit credit Reussi !');
            // return $this->redirectToRoute('app_configuration_credit_index', [], Response::HTTP_SEE_OTHER);
            // return $this->redirectToRoute('app_configuration_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('configuration_credit/new.html.twig', [
            'configuration_credit' => $configurationCredit,
            'produit'=>$produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_configuration_credit_show', methods: ['GET'])]
    public function show(ConfigurationCredit $configurationCredit): Response
    {
        return $this->render('configuration_credit/show.html.twig', [
            'configuration_credit' => $configurationCredit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_configuration_credit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ConfigurationCredit $configurationCredit, ConfigurationCreditRepository $configurationCreditRepository): Response
    {
        $form = $this->createForm(ConfigurationCreditType::class, $configurationCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $configurationCreditRepository->save($configurationCredit, true);
            
            return $this->redirectToRoute('app_liste_produit_configure', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('configuration_credit/edit.html.twig', [
            'configuration_credit' => $configurationCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_configuration_credit_delete', methods: ['POST'])]
    public function delete(Request $request, ConfigurationCredit $configurationCredit, ConfigurationCreditRepository $configurationCreditRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$configurationCredit->getId(), $request->request->get('_token'))) {
            $configurationCreditRepository->remove($configurationCredit, true);
        }

        return $this->redirectToRoute('app_configuration_credit_index', [], Response::HTTP_SEE_OTHER);
    }
}
