<?php

namespace App\Controller\configurationCredit;

use App\Entity\CompteGL1;
use App\Form\CompteGL1Type;
use App\Repository\CompteGL1Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/compte/g/l1')]
class CompteGL1Controller extends AbstractController
{
    #[Route('/', name: 'app_compte_g_l1_index', methods: ['GET'])]
    public function index(CompteGL1Repository $compteGL1Repository): Response
    {
        return $this->render('compte_gl1/index.html.twig', [
            'compte_g_l1s' => $compteGL1Repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_compte_g_l1_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CompteGL1Repository $compteGL1Repository): Response
    {
        $compteGL1 = new CompteGL1();
        $form = $this->createForm(CompteGL1Type::class, $compteGL1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compteGL1Repository->add($compteGL1, true);

            return $this->redirectToRoute('app_compte_g_l1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('compte_gl1/new.html.twig', [
            'compte_g_l1' => $compteGL1,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_compte_g_l1_show', methods: ['GET'])]
    public function show(CompteGL1 $compteGL1): Response
    {
        return $this->render('compte_gl1/show.html.twig', [
            'compte_g_l1' => $compteGL1,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_compte_g_l1_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CompteGL1 $compteGL1, CompteGL1Repository $compteGL1Repository): Response
    {
        $form = $this->createForm(CompteGL1Type::class, $compteGL1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compteGL1Repository->add($compteGL1, true);

            return $this->redirectToRoute('app_compte_g_l1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('compte_gl1/edit.html.twig', [
            'compte_g_l1' => $compteGL1,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_compte_g_l1_delete', methods: ['POST'])]
    public function delete(Request $request, CompteGL1 $compteGL1, CompteGL1Repository $compteGL1Repository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compteGL1->getId(), $request->request->get('_token'))) {
            $compteGL1Repository->remove($compteGL1, true);
        }

        return $this->redirectToRoute('app_compte_g_l1_index', [], Response::HTTP_SEE_OTHER);
    }
}
