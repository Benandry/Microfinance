<?php

namespace App\Controller\Comptabilite;

use App\Entity\Analytique;
use App\Form\AnalytiqueType;
use App\Repository\AnalytiqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/analytique')]
class AnalytiqueController extends AbstractController
{
    #[Route('/', name: 'app_analytique_index', methods: ['GET'])]
    public function index(AnalytiqueRepository $analytiqueRepository): Response
    {
        return $this->render('analytique/index.html.twig', [
            'analytiques' => $analytiqueRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_analytique_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AnalytiqueRepository $analytiqueRepository): Response
    {
        $analytique = new Analytique();
        $form = $this->createForm(AnalytiqueType::class, $analytique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $analytiqueRepository->save($analytique, true);

            return $this->redirectToRoute('app_analytique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('analytique/new.html.twig', [
            'analytiques' => $analytiqueRepository->findAll(),
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_analytique_show', methods: ['GET'])]
    public function show(Analytique $analytique): Response
    {
        return $this->render('analytique/show.html.twig', [
            'analytique' => $analytique,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_analytique_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Analytique $analytique, AnalytiqueRepository $analytiqueRepository): Response
    {
        $form = $this->createForm(AnalytiqueType::class, $analytique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $analytiqueRepository->save($analytique, true);

            return $this->redirectToRoute('app_analytique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('analytique/edit.html.twig', [
            'analytique' => $analytique,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_analytique_delete', methods: ['POST'])]
    public function delete(Request $request, Analytique $analytique, AnalytiqueRepository $analytiqueRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$analytique->getId(), $request->request->get('_token'))) {
            $analytiqueRepository->remove($analytique, true);
        }

        return $this->redirectToRoute('app_analytique_index', [], Response::HTTP_SEE_OTHER);
    }
}
