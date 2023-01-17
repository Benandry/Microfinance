<?php

namespace App\Controller\Comptabilite;

use App\Entity\PlanComptableTier;
use App\Form\PlanComptableTierType;
use App\Repository\PlanComptableTierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/plan/comptable/tier')]
class PlanComptableTierController extends AbstractController
{
    #[Route('/index', name: 'app_plan_comptable_tier_index', methods: ['GET'])]
    public function index(PlanComptableTierRepository $planComptableTierRepository): Response
    {
        return $this->render('plan_comptable_tier/index.html.twig', [
            'plan_comptable_tiers' => $planComptableTierRepository->findAll(),
        ]);
    }


    #[Route('/new', name: 'app_plan_comptable_tier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PlanComptableTierRepository $planComptableTierRepository): Response
    {
        $planComptableTier = new PlanComptableTier();
        $form = $this->createForm(PlanComptableTierType::class, $planComptableTier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $planComptableTierRepository->save($planComptableTier, true);

            return $this->redirectToRoute('app_plan_comptable_tier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plan_comptable_tier/new.html.twig', [
            'plan_comptable_tier' => $planComptableTier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plan_comptable_tier_show', methods: ['GET'])]
    public function show(PlanComptableTier $planComptableTier): Response
    {
        return $this->render('plan_comptable_tier/show.html.twig', [
            'plan_comptable_tier' => $planComptableTier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_plan_comptable_tier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PlanComptableTier $planComptableTier, PlanComptableTierRepository $planComptableTierRepository): Response
    {
        $form = $this->createForm(PlanComptableTierType::class, $planComptableTier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $planComptableTierRepository->save($planComptableTier, true);

            return $this->redirectToRoute('app_plan_comptable_tier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plan_comptable_tier/edit.html.twig', [
            'plan_comptable_tier' => $planComptableTier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plan_comptable_tier_delete', methods: ['POST'])]
    public function delete(Request $request, PlanComptableTier $planComptableTier, PlanComptableTierRepository $planComptableTierRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planComptableTier->getId(), $request->request->get('_token'))) {
            $planComptableTierRepository->remove($planComptableTier, true);
        }

        return $this->redirectToRoute('app_plan_comptable_tier_index', [], Response::HTTP_SEE_OTHER);
    }
}
