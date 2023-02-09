<?php

namespace App\Controller\Comptabilite;

use App\Entity\PlanBudget;
use App\Form\PlanBudgetType;
use App\Repository\PlanBudgetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/plan/budget')]
class PlanBudgetController extends AbstractController
{
    #[Route('/', name: 'app_plan_budget_index', methods: ['GET'])]
    public function index(PlanBudgetRepository $planBudgetRepository): Response
    {
        return $this->render('plan_budget/index.html.twig', [
            'plan_budgets' => $planBudgetRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_plan_budget_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PlanBudgetRepository $planBudgetRepository): Response
    {
        $planBudget = new PlanBudget();
        $form = $this->createForm(PlanBudgetType::class, $planBudget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $planBudgetRepository->save($planBudget, true);

            return $this->redirectToRoute('app_plan_budget_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plan_budget/new.html.twig', [
            'plan_budget' => $planBudget,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plan_budget_show', methods: ['GET'])]
    public function show(PlanBudget $planBudget): Response
    {
        return $this->render('plan_budget/show.html.twig', [
            'plan_budget' => $planBudget,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_plan_budget_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PlanBudget $planBudget, PlanBudgetRepository $planBudgetRepository): Response
    {
        $form = $this->createForm(PlanBudgetType::class, $planBudget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $planBudgetRepository->save($planBudget, true);

            return $this->redirectToRoute('app_plan_budget_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plan_budget/edit.html.twig', [
            'plan_budget' => $planBudget,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plan_budget_delete', methods: ['POST'])]
    public function delete(Request $request, PlanBudget $planBudget, PlanBudgetRepository $planBudgetRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planBudget->getId(), $request->request->get('_token'))) {
            $planBudgetRepository->remove($planBudget, true);
        }

        return $this->redirectToRoute('app_plan_budget_index', [], Response::HTTP_SEE_OTHER);
    }
}
