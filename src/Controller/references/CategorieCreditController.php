<?php

namespace App\Controller\references;

use App\Entity\CategorieCredit;
use App\Form\CategorieCreditType;
use App\Repository\CategorieCreditRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categorie/credit')]
class CategorieCreditController extends AbstractController
{
    #[Route('/', name: 'app_categorie_credit_index', methods: ['GET'])]
    public function index(CategorieCreditRepository $categorieCreditRepository): Response
    {
        return $this->render('categorie_credit/index.html.twig', [
            'categorie_credits' => $categorieCreditRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categorie_credit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CategorieCreditRepository $categorieCreditRepository): Response
    {
        $categorieCredit = new CategorieCredit();
        $form = $this->createForm(CategorieCreditType::class, $categorieCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorieCreditRepository->add($categorieCredit, true);

            return $this->redirectToRoute('app_categorie_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie_credit/new.html.twig', [
            'categorie_credit' => $categorieCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_credit_show', methods: ['GET'])]
    public function show(CategorieCredit $categorieCredit): Response
    {
        return $this->render('categorie_credit/show.html.twig', [
            'categorie_credit' => $categorieCredit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categorie_credit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategorieCredit $categorieCredit, CategorieCreditRepository $categorieCreditRepository): Response
    {
        $form = $this->createForm(CategorieCreditType::class, $categorieCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorieCreditRepository->add($categorieCredit, true);

            return $this->redirectToRoute('app_categorie_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie_credit/edit.html.twig', [
            'categorie_credit' => $categorieCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_credit_delete', methods: ['POST'])]
    public function delete(Request $request, CategorieCredit $categorieCredit, CategorieCreditRepository $categorieCreditRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorieCredit->getId(), $request->request->get('_token'))) {
            $categorieCreditRepository->remove($categorieCredit, true);
        }

        return $this->redirectToRoute('app_categorie_credit_index', [], Response::HTTP_SEE_OTHER);
    }
}
