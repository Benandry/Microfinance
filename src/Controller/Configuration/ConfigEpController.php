<?php

namespace App\Controller\Configuration;

use App\Entity\ConfigEp;
use App\Form\ConfigEpType;
use App\Repository\ConfigEpRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/config/ep')]
class ConfigEpController extends AbstractController
{
    #[Route('/', name: 'app_config_ep_index', methods: ['GET'])]
    public function index(ConfigEpRepository $configEpRepository): Response
    {
        $config=$configEpRepository->Configuration();
        return $this->render('Configuration/config_ep/index.html.twig', [
            'config_eps' => $configEpRepository->findAll(),
            'configs'=>$config,
        ]);
    }

    #[Route('/new', name: 'app_config_ep_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ConfigEpRepository $configEpRepository): Response
    {
        $configEp = new ConfigEp();
        $form = $this->createForm(ConfigEpType::class, $configEp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $configEpRepository->add($configEp, true);

            $this->addFlash('success', "Ajout de configuration epargne : reussite!!");
            return $this->redirectToRoute('app_config_ep_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Configuration/config_ep/new.html.twig', [
            'config_ep' => $configEp,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_config_ep_show', methods: ['GET'])]
    public function show(ManagerRegistry $doctrine,int $id): Response
    {
        $configEp=$doctrine->getRepository(ConfigEp::class)->find($id);
        $produit=$configEp->getProduitEp();
        return $this->render('Configuration/config_ep/show.html.twig', [
            'configs' => $configEp,
            'produits'=>$produit
        ]);
    }

    #[Route('/{id}/edit', name: 'app_config_ep_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ConfigEp $configEp, ConfigEpRepository $configEpRepository): Response
    {
        $form = $this->createForm(ConfigEpType::class, $configEp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $configEpRepository->add($configEp, true);

            $this->addFlash('success', "Modification de configuration epargne : reussite!!");
            return $this->redirectToRoute('app_config_ep_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Configuration/config_ep/edit.html.twig', [
            'config_ep' => $configEp,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_config_ep_delete', methods: ['POST'])]
    public function delete(Request $request, ConfigEp $configEp, ConfigEpRepository $configEpRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$configEp->getId(), $request->request->get('_token'))) {
            $configEpRepository->remove($configEp, true);
        }

        $this->addFlash('success', "Suppression de configuration epargne : reussite!!");
        return $this->redirectToRoute('app_config_ep_index', [], Response::HTTP_SEE_OTHER);
    }
}
