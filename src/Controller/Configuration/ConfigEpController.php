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
            /**Verifier les produit s'il est deja configurer ou pas */
            $_is_configured = $configEpRepository->findProduitConfigEp($configEp->getProduitEpargne());
            if($_is_configured){
                //If les produit est deja configurer on ne pas le refaire
                // dd("deja configurer");
                $this->addFlash('info', "Configuration epargne échoué parce que le produit ' ".$configEp->getProduitEpargne()->getNomproduit()." ' est déja configuré!!");
            }else {
                // Sinon On peut configurer
                // dd("On peut configurer");
                $configEpRepository->add($configEp, true);
                $this->addFlash('success', "Ajout de configuration du produits '".$configEp->getProduitEpargne()->getNomproduit()." '  réussite!!");
            }
            return $this->redirectToRoute('app_config_ep_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Configuration/config_ep/new.html.twig', [
            'config_ep' => $configEp,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_config_ep_show', methods: ['GET'])]
    public function show(ManagerRegistry $doctrine,ConfigEp $config): Response
    {
        // dd($config);
        return $this->render('Configuration/config_ep/show.html.twig', [
            'configs' => $config,
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
