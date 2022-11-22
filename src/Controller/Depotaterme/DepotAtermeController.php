<?php

namespace App\Controller\Depotaterme;

use App\Entity\DepotAterme;
use App\Form\DepotAtermeType;
use App\Repository\DepotAtermeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/depot/aterme')]
class DepotAtermeController extends AbstractController
{
    #[Route('/', name: 'app_depot_aterme_index', methods: ['GET'])]
    public function index(DepotAtermeRepository $depotAtermeRepository): Response
    {
        return $this->render('depot_aterme/index.html.twig', [
            'depot_atermes' => $depotAtermeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_depot_aterme_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DepotAtermeRepository $depotAtermeRepository): Response
    {
        $depotAterme = new DepotAterme();
        $form = $this->createForm(DepotAtermeType::class, $depotAterme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $depotAtermeRepository->add($depotAterme, true);

            return $this->redirectToRoute('app_depot_aterme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('depot_aterme/new.html.twig', [
            'depot_aterme' => $depotAterme,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_depot_aterme_show', methods: ['GET'])]
    public function show(DepotAterme $depotAterme): Response
    {
        return $this->render('depot_aterme/show.html.twig', [
            'depot_aterme' => $depotAterme,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_depot_aterme_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DepotAterme $depotAterme, DepotAtermeRepository $depotAtermeRepository): Response
    {
        $form = $this->createForm(DepotAtermeType::class, $depotAterme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $depotAtermeRepository->add($depotAterme, true);

            return $this->redirectToRoute('app_depot_aterme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('depot_aterme/edit.html.twig', [
            'depot_aterme' => $depotAterme,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_depot_aterme_delete', methods: ['POST'])]
    public function delete(Request $request, DepotAterme $depotAterme, DepotAtermeRepository $depotAtermeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$depotAterme->getId(), $request->request->get('_token'))) {
            $depotAtermeRepository->remove($depotAterme, true);
        }

        return $this->redirectToRoute('app_depot_aterme_index', [], Response::HTTP_SEE_OTHER);
    }
}
