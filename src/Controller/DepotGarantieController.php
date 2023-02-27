<?php

namespace App\Controller;

use App\Entity\CompteEpargne;
use App\Entity\Groupe;
use App\Entity\Individuelclient;
use App\Repository\IndividuelclientRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepotGarantieController extends AbstractController
{
    #[Route('/depot/garantie/individuel', name: 'app_depot_garantie')]
    public function index(Request $request): Response
    {
        // dFORMULAIRE DE CLIENTPOUR OUVRIR UNE DEPOT DE GARANTIE
        $form = $this->createFormBuilder()
            ->add('client',EntityType::class,[
                'class' => Individuelclient::class,
                'label' => false,
                'placeholder' => "Client individuel",
                'choice_label' => function($client) {
                    return $client->getNomClient()." ".$client->getPrenomClient();
                },
                'query_builder' => function(IndividuelclientRepository $repo){
                    return $repo->createQueryBuilder('cli')
                    ->where('cli.garant = 0');
                },
                'attr' => [
                    'class' => "form-control border-0",
                ],
                'autocomplete' => true,
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
           $client = $form->getData()['client'];
           $status = "garantie";
           return $this->redirectToRoute("app_compte_epargne_new",['code' => $client,"status" => $status],Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('depot_garantie/individuel.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/depot/garantie/groupe', name: 'app_depot_garantie_groupe')]
    public function newcompte(Request $request): Response
    {
        // dFORMULAIRE DE CLIENTPOUR OUVRIR UNE DEPOT DE GARANTIE
        $form = $this->createFormBuilder()
            ->add('client',EntityType::class,[
                'class' => Groupe::class,
                'label' => false,
                'placeholder' => "Client groupe",
                'choice_label' => function($client) {
                    return $client->getNomGroupe();
                },
                'attr' => [
                    'class' => "form-control border-0",
                ],
                'autocomplete' => true,
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
           $client = $form->getData()['client'];
           $status = "garantie";
           return $this->redirectToRoute("app_compte_epargne_new_groupe",['code' => $client,"status" => $status],Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('depot_garantie/groupe.html.twig', [
            'form' => $form,
        ]);
    }
}
