<?php

namespace App\Controller\Module_client;

use App\Entity\SuiviClient;
use App\Form\SuiviClientType;
use App\Repository\SuiviClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/suivi/client')]
class SuiviClientController extends AbstractController
{
    #[Route('/', name: 'app_suivi_client_index', methods: ['GET'])]
    public function index(SuiviClientRepository $suiviClientRepository): Response
    {
        return $this->render('Module_client/suivi_client/index.html.twig', [
            'suivi_clients' => $suiviClientRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_suivi_client_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SuiviClientRepository $suiviClientRepository): Response
    {
        $suiviClient = new SuiviClient();
        $form = $this->createForm(SuiviClientType::class, $suiviClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $suiviClientRepository->add($suiviClient, true);

            return $this->redirectToRoute('app_suivi_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_client/suivi_client/new.html.twig', [
            'suivi_client' => $suiviClient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_suivi_client_show', methods: ['GET'])]
    public function show(SuiviClient $suiviClient): Response
    {
        return $this->render('Module_client/suivi_client/show.html.twig', [
            'suivi_client' => $suiviClient,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_suivi_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SuiviClient $suiviClient, SuiviClientRepository $suiviClientRepository): Response
    {
        $form = $this->createForm(SuiviClientType::class, $suiviClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $suiviClientRepository->add($suiviClient, true);

            return $this->redirectToRoute('app_suivi_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_client/suivi_client/edit.html.twig', [
            'suivi_client' => $suiviClient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_suivi_client_delete', methods: ['POST'])]
    public function delete(Request $request, SuiviClient $suiviClient, SuiviClientRepository $suiviClientRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$suiviClient->getId(), $request->request->get('_token'))) {
            $suiviClientRepository->remove($suiviClient, true);
        }

        return $this->redirectToRoute('app_suivi_client_index', [], Response::HTTP_SEE_OTHER);
    }
}
