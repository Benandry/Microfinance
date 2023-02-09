<?php

namespace App\Controller\Credit;

use App\Entity\AmortissementFixe;
use App\Form\AmortissementFixeType;
use App\Repository\AmortissementFixeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/amortissement/fixe')]
class AmortissementFixeController extends AbstractController
{
    #[Route('/', name: 'app_amortissement_fixe_index', methods: ['GET'])]
    public function index(AmortissementFixeRepository $amortissementFixeRepository): Response
    {
        return $this->render('amortissement_fixe/index.html.twig', [
            'amortissement_fixes' => $amortissementFixeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_amortissement_fixe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AmortissementFixeRepository $amortissementFixeRepository): Response
    {
        $amortissementFixe = new AmortissementFixe();
        $form = $this->createForm(AmortissementFixeType::class, $amortissementFixe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $amortissementFixeRepository->add($amortissementFixe, true);

            return $this->redirectToRoute('app_amortissement_fixe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('amortissement_fixe/new.html.twig', [
            'amortissement_fixe' => $amortissementFixe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_amortissement_fixe_show', methods: ['GET'])]
    public function show(AmortissementFixe $amortissementFixe): Response
    {
        return $this->render('amortissement_fixe/show.html.twig', [
            'amortissement_fixe' => $amortissementFixe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_amortissement_fixe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AmortissementFixe $amortissementFixe, AmortissementFixeRepository $amortissementFixeRepository): Response
    {
        $form = $this->createForm(AmortissementFixeType::class, $amortissementFixe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $amortissementFixeRepository->add($amortissementFixe, true);
            $codecredit = $form->getData()->getCodecredit();

           // dd($form->getData()->getTypeamortissement());
            $this->addFlash('success', "Modification sur le periode ".$form->getData()->getPeriode());

            if($form->getData()->getTypeamortissement() == 'simple'){    
                return $this->redirectToRoute('app_tableau_amortissement', [
                    'codecredit' => $codecredit
                ], Response::HTTP_SEE_OTHER);
            }
            elseif($form->getData()->getTypeamortissement() == 'anuuite constante')
            {
                return $this->redirectToRoute('app_tableau_amortissement_annuite_constante', [
                    'codecredit' => $codecredit
                ], Response::HTTP_SEE_OTHER);
            }

            elseif($form->getData()->getTypeamortissement() == 'amortissement constante')
            {
                return $this->redirectToRoute('app_tableau_amortissement_remboursement_constante', [
                    'codecredit' => $codecredit
                ], Response::HTTP_SEE_OTHER);
            }

        }

        return $this->renderForm('amortissement_fixe/edit.html.twig', [
            'amortissement_fixe' => $amortissementFixe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_amortissement_fixe_delete', methods: ['POST'])]
    public function delete(Request $request, AmortissementFixe $amortissementFixe, AmortissementFixeRepository $amortissementFixeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$amortissementFixe->getId(), $request->request->get('_token'))) {
            $amortissementFixeRepository->remove($amortissementFixe, true);
        }

        return $this->redirectToRoute('app_amortissement_fixe_index', [], Response::HTTP_SEE_OTHER);
    }
}
