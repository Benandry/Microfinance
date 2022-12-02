<?php

namespace App\Controller\configurationCredit;

use App\Entity\ConfigurationGeneralCredit;
use App\Form\ConfigurationGeneralCreditType;
use App\Repository\ConfigurationGeneralCreditRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/configuration/general/credit')]
class ConfigurationGeneralCreditController extends AbstractController
{
    #[Route('/', name: 'app_configuration_general_credit_index', methods: ['GET'])]
    public function index(ConfigurationGeneralCreditRepository $configurationGeneralCreditRepository): Response
    {
        return $this->render('configuration_general_credit/index.html.twig', [
            'configuration_general_credits' => $configurationGeneralCreditRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_configuration_general_credit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ConfigurationGeneralCreditRepository $configurationGeneralCreditRepository): Response
    {
        $configurationGeneralCredit = new ConfigurationGeneralCredit();
        $form = $this->createForm(ConfigurationGeneralCreditType::class, $configurationGeneralCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $configurationGeneralCreditRepository->add($configurationGeneralCredit, true);

            $this->addFlash('success', "Configuration feneral du credit avec success !");
        }

        return $this->renderForm('configuration_general_credit/new.html.twig', [
            'configuration_general_credit' => $configurationGeneralCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_configuration_general_credit_show', methods: ['GET'])]
    public function show(ConfigurationGeneralCredit $configurationGeneralCredit): Response
    {
        return $this->render('configuration_general_credit/show.html.twig', [
            'configuration_general_credit' => $configurationGeneralCredit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_configuration_general_credit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ConfigurationGeneralCredit $configurationGeneralCredit, ConfigurationGeneralCreditRepository $configurationGeneralCreditRepository): Response
    {
        $form = $this->createForm(ConfigurationGeneralCreditType::class, $configurationGeneralCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $configurationGeneralCreditRepository->add($configurationGeneralCredit, true);

            return $this->redirectToRoute('app_configuration_general_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('configuration_general_credit/edit.html.twig', [
            'configuration_general_credit' => $configurationGeneralCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_configuration_general_credit_delete', methods: ['POST'])]
    public function delete(Request $request, ConfigurationGeneralCredit $configurationGeneralCredit, ConfigurationGeneralCreditRepository $configurationGeneralCreditRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$configurationGeneralCredit->getId(), $request->request->get('_token'))) {
            $configurationGeneralCreditRepository->remove($configurationGeneralCredit, true);
        }

        return $this->redirectToRoute('app_configuration_general_credit_index', [], Response::HTTP_SEE_OTHER);
    }
}
