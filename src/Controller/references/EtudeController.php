<?php

namespace App\Controller\references;

use App\Entity\Etude;
use App\Form\EtudeType;
use App\Repository\EtudeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/etude')]
class EtudeController extends AbstractController
{
    #[Route('/', name: 'app_etude_index', methods: ['GET'])]
    public function index(EtudeRepository $etudeRepository): Response
    {
        return $this->render('references/etude/index.html.twig', [
            'etudes' => $etudeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_etude_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EtudeRepository $etudeRepository): Response
    {
        $etude = new Etude();
        $form = $this->createForm(EtudeType::class, $etude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etudeRepository->add($etude, true);

            $this->addFlash('success', "Ajout de niveau d'etude :  ".$etude->getNiveau()."  reussite!!");
            return $this->redirectToRoute('app_etude_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('references/etude/new.html.twig', [
            'etude' => $etude,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etude_show', methods: ['GET'])]
    public function show(Etude $etude): Response
    {
        return $this->render('references/etude/show.html.twig', [
            'etude' => $etude,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_etude_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Etude $etude, EtudeRepository $etudeRepository): Response
    {
        $form = $this->createForm(EtudeType::class, $etude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etudeRepository->add($etude, true);

            $this->addFlash('success', "Modification de niveau :  ".$etude->getNiveau()."  reussite!!");
            return $this->redirectToRoute('app_etude_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('references/etude/edit.html.twig', [
            'etude' => $etude,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etude_delete', methods: ['POST'])]
    public function delete(Request $request, Etude $etude, EtudeRepository $etudeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etude->getId(), $request->request->get('_token'))) {
            $etudeRepository->remove($etude, true);
        }

        $this->addFlash('success', "Suprression de niveau :  ".$etude->getNiveau()."  reussite!!");
        return $this->redirectToRoute('app_etude_index', [], Response::HTTP_SEE_OTHER);
    }
}
