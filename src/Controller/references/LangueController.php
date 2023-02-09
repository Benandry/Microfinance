<?php

namespace App\Controller\references;

use App\Entity\Langue;
use App\Form\LangueType;
use App\Repository\LangueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/langue')]
class LangueController extends AbstractController
{
    #[Route('/', name: 'app_langue_index', methods: ['GET'])]
    public function index(LangueRepository $langueRepository): Response
    {
        return $this->render('references/langue/index.html.twig', [
            'langues' => $langueRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_langue_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LangueRepository $langueRepository): Response
    {
        $langue = new Langue();
        $form = $this->createForm(LangueType::class, $langue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $langueRepository->add($langue, true);

            $this->addFlash('success', "Ajout du langue ".$langue->getLangue()."  reuissite !");
            return $this->redirectToRoute('app_langue_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('references/langue/new.html.twig', [
            'langue' => $langue,
            'form' => $form,
        ]);
    }

    #[Route('/show/{id}', name: 'app_langue_show', methods: ['GET'])]
    public function show(Langue $langue): Response
    {
        return $this->render('references/langue/show.html.twig', [
            'langue' => $langue,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_langue_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Langue $langue, LangueRepository $langueRepository): Response
    {
        $form = $this->createForm(LangueType::class, $langue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $langueRepository->add($langue, true);
            $this->addFlash('success', "Modification du langue ".$langue->getLangue()."  reussite!!");
            return $this->redirectToRoute('app_langue_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('references/langue/edit.html.twig', [
            'langue' => $langue,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_langue_delete', methods: ['GET', 'POST'])]
    public function delete(Request $request, Langue $langue, LangueRepository $langueRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$langue->getId(), $request->request->get('_token'))) {
            $langueRepository->remove($langue, true);
        }
        $this->addFlash('success', "Suppression  ".$langue->getLangue()." reuissite !!!");
        return $this->redirectToRoute('app_langue_index', [], Response::HTTP_SEE_OTHER);
    }
}
