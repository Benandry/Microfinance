<?php

namespace App\Controller\configurationCredit;

use App\Entity\GarantieCredit;
use App\Form\GarantieCreditType;
use App\Repository\GarantieCreditRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/garantie/credit')]
class GarantieCreditController extends AbstractController
{
    #[Route('/', name: 'app_garantie_credit_index', methods: ['GET'])]
    public function index(GarantieCreditRepository $garantieCreditRepository): Response
    {
        return $this->render('garantie_credit/index.html.twig', [
            'garantie_credits' => $garantieCreditRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_garantie_credit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GarantieCreditRepository $garantieCreditRepository): Response
    {
        $garantieCredit = new GarantieCredit();
        $form = $this->createForm(GarantieCreditType::class, $garantieCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $garantieCreditRepository->add($garantieCredit, true);

            return $this->redirectToRoute('app_garantie_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('garantie_credit/new.html.twig', [
            'garantie_credit' => $garantieCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_garantie_credit_show', methods: ['GET'])]
    public function show(GarantieCredit $garantieCredit): Response
    {
        return $this->render('garantie_credit/show.html.twig', [
            'garantie_credit' => $garantieCredit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_garantie_credit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GarantieCredit $garantieCredit, GarantieCreditRepository $garantieCreditRepository): Response
    {
        $form = $this->createForm(GarantieCreditType::class, $garantieCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $garantieCreditRepository->add($garantieCredit, true);

            return $this->redirectToRoute('app_garantie_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('garantie_credit/edit.html.twig', [
            'garantie_credit' => $garantieCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_garantie_credit_delete', methods: ['POST'])]
    public function delete(Request $request, GarantieCredit $garantieCredit, GarantieCreditRepository $garantieCreditRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$garantieCredit->getId(), $request->request->get('_token'))) {
            $garantieCreditRepository->remove($garantieCredit, true);
        }

        return $this->redirectToRoute('app_garantie_credit_index', [], Response::HTTP_SEE_OTHER);
    }
}
