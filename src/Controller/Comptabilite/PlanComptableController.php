<?php

namespace App\Controller\Comptabilite;

use App\Entity\PlanComptable;
use App\Form\PlanComptableType;
use App\Repository\PlanComptableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/plan/comptable')]
class PlanComptableController extends AbstractController
{
    #[Route('/', name: 'app_plan_comptable_index', methods: ['GET'])]
    public function index(PlanComptableRepository $planComptableRepository): Response
    {
        return $this->render('plan_comptable/index.html.twig', [
            'plan_comptables' => $planComptableRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_plan_comptable_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PlanComptableRepository $planComptableRepository): Response
    {
        $planComptable = new PlanComptable();
        $form = $this->createForm(PlanComptableType::class, $planComptable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $planComptableRepository->add($planComptable, true);

            return $this->redirectToRoute('app_plan_comptable_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plan_comptable/new.html.twig', [
            'plan_comptable' => $planComptable,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plan_comptable_show', methods: ['GET'])]
    public function show(PlanComptable $planComptable): Response
    {
        return $this->render('plan_comptable/show.html.twig', [
            'plan_comptable' => $planComptable,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_plan_comptable_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PlanComptable $planComptable, PlanComptableRepository $planComptableRepository): Response
    {
        $form = $this->createForm(PlanComptableType::class, $planComptable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $planComptableRepository->add($planComptable, true);

            return $this->redirectToRoute('app_plan_comptable_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plan_comptable/edit.html.twig', [
            'plan_comptable' => $planComptable,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plan_comptable_delete', methods: ['POST'])]
    public function delete(Request $request, PlanComptable $planComptable, PlanComptableRepository $planComptableRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planComptable->getId(), $request->request->get('_token'))) {
            $planComptableRepository->remove($planComptable, true);
        }

        return $this->redirectToRoute('app_plan_comptable_index', [], Response::HTTP_SEE_OTHER);
    }
}
