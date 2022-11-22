<?php

namespace App\Controller\Module_client;

use App\Entity\Agence;
use App\Form\AgenceType;
use App\Repository\AgenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/agence')]
class AgenceController extends AbstractController
{
    #[Route('/', name: 'app_agence_index', methods: ['GET'])]
    public function index(AgenceRepository $agenceRepository): Response
    {
        $agence=$agenceRepository->ListeAgence();

       // dd($agence);

        return $this->render('Module_client/agence/index.html.twig', [
            'agences' => $agence,
        ]);
    }

    #[Route('/new', name: 'app_agence_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AgenceRepository $agenceRepository): Response
    {
        $agence = new Agence();
        $form = $this->createForm(AgenceType::class, $agence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $agenceRepository->add($agence, true);

            return $this->redirectToRoute('app_agence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_client/agence/new.html.twig', [
            'agence' => $agence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_agence_show', methods: ['GET'])]
    public function show(Agence $agence): Response
    {
        return $this->render('Module_client/agence/show.html.twig', [
            'agence' => $agence,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_agence_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Agence $agence, AgenceRepository $agenceRepository): Response
    {
        $form = $this->createForm(AgenceType::class, $agence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $agenceRepository->add($agence, true);

            return $this->redirectToRoute('app_agence_index', [], Response::HTTP_SEE_OTHER);
        }

        //dd($agence);

        return $this->renderForm('Module_client/agence/edit.html.twig', [
            'agence' => $agence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_agence_delete', methods: ['POST'])]
    public function delete(Request $request, Agence $agence, AgenceRepository $agenceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$agence->getId(), $request->request->get('_token'))) {
            $agenceRepository->remove($agence, true);
        }

        return $this->redirectToRoute('app_agence_index', [], Response::HTTP_SEE_OTHER);
    }
}
