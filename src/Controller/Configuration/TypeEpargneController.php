<?php

namespace App\Controller\Configuration;

use App\Entity\TypeEpargne;
use App\Form\TypeEpargneType;
use App\Repository\TypeEpargneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/type/epargne')]
class TypeEpargneController extends AbstractController
{
    #[Route('/', name: 'app_type_epargne_index', methods: ['GET'])]
    public function index(TypeEpargneRepository $typeEpargneRepository): Response
    {
        return $this->render('Configuration/type_epargne/index.html.twig', [
            'type_epargnes' => $typeEpargneRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_epargne_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TypeEpargneRepository $typeEpargneRepository): Response
    {
        $typeEpargne = new TypeEpargne();
        $form = $this->createForm(TypeEpargneType::class, $typeEpargne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeEpargneRepository->add($typeEpargne, true);

            $this->addFlash('success', "Ajout de type epargne :  ".$typeEpargne->getNomTypeEp()."  reussite!!");
            return $this->redirectToRoute('app_type_epargne_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Configuration/type_epargne/new.html.twig', [
            'type_epargne' => $typeEpargne,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_epargne_show', methods: ['GET'])]
    public function show(TypeEpargne $typeEpargne): Response
    {
        return $this->render('Configuration/type_epargne/show.html.twig', [
            'type_epargne' => $typeEpargne,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_epargne_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeEpargne $typeEpargne, TypeEpargneRepository $typeEpargneRepository): Response
    {
        $form = $this->createForm(TypeEpargneType::class, $typeEpargne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeEpargneRepository->add($typeEpargne, true);

            $this->addFlash('success', "Modification de type :  ' ".$typeEpargne->getNomTypeEp()." ' reussite!!");
            return $this->redirectToRoute('app_type_epargne_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Configuration/type_epargne/edit.html.twig', [
            'type_epargne' => $typeEpargne,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_epargne_delete', methods: ['POST'])]
    public function delete(Request $request, TypeEpargne $typeEpargne, TypeEpargneRepository $typeEpargneRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeEpargne->getId(), $request->request->get('_token'))) {
            $typeEpargneRepository->remove($typeEpargne, true);
        }

        $this->addFlash('success', "Suppression de type epargne : ' ".$typeEpargne->getNomTypeEp()." ' reussite!!");
        return $this->redirectToRoute('app_type_epargne_index', [], Response::HTTP_SEE_OTHER);
    }
}
