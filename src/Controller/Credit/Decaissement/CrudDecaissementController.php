<?php

namespace App\Controller\Credit\Decaissement;

use App\Entity\Decaissement;
use App\Form\DecaissementType;
use App\Repository\DecaissementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('decaissement/credit/crud')]
class CrudDecaissementController extends AbstractController
{
    #[Route('/', name: 'app_crud_decaissement_index', methods: ['GET'])]
    public function index(DecaissementRepository $decaissementRepository): Response
    {
        return $this->render('crud_decaissement/index.html.twig', [
            'decaissements' => $decaissementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_crud_decaissement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DecaissementRepository $decaissementRepository): Response
    {
        $demandeApprouver = $request->query->all();

       // dd($demandeApprouver['liste']);

        $decaissement = new Decaissement();
        $form = $this->createForm(DecaissementType::class, $decaissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $decaissementRepository->add($decaissement, true);
            $this->addFlash('success', "Decaissement de credit  ".$decaissement->getNumeroCredit()." reuissite ");
            return $this->redirectToRoute('app_decaissement_credit', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_credit/crud_decaissement/new.html.twig', [
            'decaissement' => $decaissement,
            'form' => $form,
            'demandes' => $demandeApprouver
        ]);
    }

    #[Route('/{id}', name: 'app_crud_decaissement_show', methods: ['GET'])]
    public function show(Decaissement $decaissement): Response
    {
        return $this->render('crud_decaissement/show.html.twig', [
            'decaissement' => $decaissement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_crud_decaissement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Decaissement $decaissement, DecaissementRepository $decaissementRepository): Response
    {
        $form = $this->createForm(DecaissementType::class, $decaissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $decaissementRepository->add($decaissement, true);

            return $this->redirectToRoute('app_crud_decaissement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud_decaissement/edit.html.twig', [
            'decaissement' => $decaissement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_crud_decaissement_delete', methods: ['POST'])]
    public function delete(Request $request, Decaissement $decaissement, DecaissementRepository $decaissementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$decaissement->getId(), $request->request->get('_token'))) {
            $decaissementRepository->remove($decaissement, true);
        }

        return $this->redirectToRoute('app_crud_decaissement_index', [], Response::HTTP_SEE_OTHER);
    }
}
