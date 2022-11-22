<?php

namespace App\Controller\references;

use App\Entity\Devise;
use App\Form\DeviseType;
use App\Repository\DeviseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/devise')]
class DeviseController extends AbstractController
{
    #[Route('/', name: 'app_devise_index', methods: ['GET'])]
    public function index(DeviseRepository $deviseRepository): Response
    {
        return $this->render('references/devise/index.html.twig', [
            'devises' => $deviseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_devise_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DeviseRepository $deviseRepository): Response
    {
        $devise = new Devise();
        $form = $this->createForm(DeviseType::class, $devise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $deviseRepository->add($devise, true);

            $this->addFlash('success', "Ajout devise:  '".$devise->getDevise()."'  reussite!!");
            return $this->redirectToRoute('app_devise_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('references/devise/new.html.twig', [
            'devise' => $devise,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_devise_show', methods: ['GET'])]
    public function show(Devise $devise): Response
    {
        return $this->render('references/devise/show.html.twig', [
            'devise' => $devise,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_devise_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Devise $devise, DeviseRepository $deviseRepository): Response
    {
        $form = $this->createForm(DeviseType::class, $devise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $deviseRepository->add($devise, true);

            $this->addFlash('success', "Modification du devise:  '".$devise->getDevise()."'  reussite!!");
            return $this->redirectToRoute('app_devise_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('references/devise/edit.html.twig', [
            'devise' => $devise,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_devise_delete', methods: ['POST'])]
    public function delete(Request $request, Devise $devise, DeviseRepository $deviseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$devise->getId(), $request->request->get('_token'))) {
            $deviseRepository->remove($devise, true);
        }

        $this->addFlash('success', "Suppression de devise:  '".$devise->getDevise()."'  reussite!!");
        return $this->redirectToRoute('app_devise_index', [], Response::HTTP_SEE_OTHER);
    }
}
