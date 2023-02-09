<?php

namespace App\Controller\Module_client;

use App\Entity\Agence;
use App\Entity\ApprouverClient;
use App\Entity\Individuelclient;
use App\Form\ApprouverClientType;
use App\Repository\AgenceRepository;
use App\Repository\ApprouverClientRepository;
use App\Repository\IndividuelclientRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/approuver/client')]
class ApprouverClientController extends AbstractController
{
    #[Route('/', name: 'app_approuver_client_index', methods: ['GET'])]
    public function index(ApprouverClientRepository $approuverClientRepository,AgenceRepository $agences): Response
    {
        $approuver=$approuverClientRepository->Approbation();
                // Agence
                $agence=$agences->findAll();


       return $this->render('Module_client/approuver_client/index.html.twig',[
        'approuvers'=>$approuver,
        'agences'=>$agence
       ]);
    }

    #[Route('/new', name: 'app_approuver_client_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ApprouverClientRepository $approuverClientRepository): Response
    {
        $approuverClient = new ApprouverClient();
        $form = $this->createForm(ApprouverClientType::class, $approuverClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $approuverClientRepository->add($approuverClient, true);

            return $this->redirectToRoute('app_approuver_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_client/approuver_client/new.HTML.twig', [
            'approuver_client' => $approuverClient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_approuver_client_show', methods: ['GET'])]
    public function show(AgenceRepository $agences,ManagerRegistry $doctrine,$id): Response
    {
        $approuver=$doctrine->getRepository(ApprouverClient::class)->find($id);
        $client=$approuver->getCodeclient();


        return $this->render('Module_client\approuver_client/show.HTML.twig', [
            'approuver_client' => $approuver,
            'clients'=>$client,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_approuver_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ApprouverClient $approuverClient, ApprouverClientRepository $approuverClientRepository): Response
    {
        $form = $this->createForm(ApprouverClientType::class, $approuverClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $approuverClientRepository->add($approuverClient, true);

            return $this->redirectToRoute('app_approuver_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_client/approuver_client/edit.HTML.twig', [
            'approuver_client' => $approuverClient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_approuver_client_delete', methods: ['POST'])]
    public function delete(Request $request, ApprouverClient $approuverClient, ApprouverClientRepository $approuverClientRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$approuverClient->getId(), $request->request->get('_token'))) {
            $approuverClientRepository->remove($approuverClient, true);
        }

        return $this->redirectToRoute('app_approuver_client_index', [], Response::HTTP_SEE_OTHER);
    }
}
