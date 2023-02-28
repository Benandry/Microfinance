<?php

namespace App\Controller\Module_epargne;

use App\Entity\CompteEpargne;
use App\Entity\Groupe;
use App\Entity\Individuelclient;
use App\Repository\CompteEpargneRepository;
use App\Repository\IndividuelclientRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ModaEpargneController extends AbstractController
{
         /**
     * Ouverture de Compte epargne individuel client
     *
     * @param Request $request
     * @return void
     */
    #[Route('/ouvrirCompteEpargneClient', name: 'app_ouvrir_compte_epargne')]
    public function ouvrirCompteEpargnr(Request $request)
    {

        $form = $this->createFormBuilder()
        ->add('code', EntityType ::class,[
                'class' => Individuelclient:: class,
                'label' => 'Individuel client : ',
                'query_builder' => function(IndividuelclientRepository $repo){
                    return $repo->createQueryBuilder('i')
                                ->where('i.garant = 0');
                },
                'placeholder' => "Choisissez l'ndividuel client :",
                'choice_label' => function($client){
                    return $client->getCodeClient()." -- ".$client->getNomClient()." ".$client->getPrenomClient();
                },
                'attr'=>[
                    'class' => 'form-control border-0 custom-select-no-arrow',
                ],
                'autocomplete' => true,
        ])

        ->getForm();
    
        $form->handleRequest($request);
    
        /* ===== Si les produits sont selectionnnés. On va executer les requests ci-dessous ====== */
        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData()['code'];
            return $this->redirectToRoute('app_compte_epargne_new', ['code' => $data],Response::HTTP_SEE_OTHER);
        }

        return $this->render('Module_epargne/compte_epargne/infoCompte/ouvrir.html.twig',[
            'form' => $form->createView(),
        ]);
    }

     /**
     * Ouverture de compte epargne en groupe
     *
     * @param Request $request
     * @return void
     */
    #[Route('/ouvrir/CompteEpargne/Groupe', name: 'app_ouvrir_compte_groupe')]
    public function compteEpargneGroup(Request $request)
    {
       $form = $this->createFormBuilder()
       ->add('code', EntityType ::class,[
               'class' => Groupe:: class,
               'label' => 'Groupe client : ',
               'placeholder' => "Choisissez le groupe :",
               'choice_label' => function($g){
                   return $g->getCodeGroupe()." -- ".$g->getNomGroupe();
               },
               'attr'=>[
                   'class' => 'form-control border-0 custom-select-no-arrow',
               ],
               'autocomplete' => true,
       ])
       ->getForm();
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()){
           $data = $form->getData()['code'];
           return $this->redirectToRoute('app_compte_epargne_new_groupe', ['code' => $data], Response::HTTP_SEE_OTHER);
       }
        return $this->render('Module_epargne/compte_epargne/infoCompte/ouverture_groupe.html.twig',[
           'form' => $form->createView(),
        ]);
    }


    /**
    * Entree Depot a Vue
    *
    * @param Request $request
    * @return void
    */
    #[Route('/CompteEpargneDepot', name: 'app_compte_epargne_depot')]
    public function compteEpargneDepot(Request $request)
    {
        $form = $this->createFormBuilder()
        ->add('code', EntityType::class,[
                'class' => CompteEpargne::class,
                'query_builder' => function (CompteEpargneRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->join("c.produit","prod")
                        ->where("c.activated = 1")
                        ->andWhere("prod.abbreviation = 'DAV'")
                        ->orWhere("prod.nomproduit = 'Dépôts a vue' ");
                },
                'choice_label' => function ($c) {
                    return $c->getCodeepargne();
                },
                'attr'=>[
                    'class' => 'form-control border-0 custom-select-no-arrow',
                ],
                'label' => "Compte epargne client individuel : ",
                'placeholder' => "Choisissez le compte epargne :",
                'autocomplete' => true,
            
        ])
        ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData()['code'];
            $status = "depot_a_vue_entree";
            return $this->redirectToRoute('app_transaction_new', ['code' => $data,'status' => $status],Response::HTTP_SEE_OTHER);
        }

        return $this->render('Module_epargne/transaction/infoTransaction/depot_a_vue_entree.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
    * Sortie Depot a Vue
    *
    * @param Request $request
    * @return void
    */
    #[Route('/Sortie/Depot_a_vu', name: 'app_depot_a_vu_sortie')]
    public function sortie(Request $request)
    {
        $form = $this->createFormBuilder()
        ->add('code', EntityType::class,[
                'class' => CompteEpargne::class,
                'query_builder' => function (CompteEpargneRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->join("c.produit","prod")
                        ->where("c.activated = 1")
                        ->andWhere("prod.abbreviation = 'DAV'")
                        ->orWhere("prod.nomproduit = 'Dépôts a vue' ");
                },
                'choice_label' => function ($c) {
                    return $c->getCodeepargne();
                },
                'attr'=>[
                    'class' => 'form-control border-0 custom-select-no-arrow',
                ],
                'label' => "Compte epargne client individuel : ",
                'placeholder' => "Choisissez le compte epargne  :",
                'autocomplete' => true,  
        ])
        ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData()['code'];
            $status = "depot_a_vue_sortie";
            return $this->redirectToRoute('app_retrait', ['code' => $data,'status' => $status],Response::HTTP_SEE_OTHER);
        }

        return $this->render('Module_epargne/transaction/infoTransaction/depot_a_vue_sortie.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * Entree depot de garantie
     *
     * @param Request $request
     * @return void
     */ 
    #[Route('/depot/garantie/entree', name: 'app_depot_de_garantie_entree')]
    public function depot_de_garantie_entree(Request $request)
    {
        $form = $this->createFormBuilder()
        ->add('code', EntityType::class,[
            'class' => CompteEpargne::class,
            'query_builder' => function (CompteEpargneRepository $er) {
                return $er->createQueryBuilder('c')
                    ->join("c.produit","prod")
                    ->where("c.activated = 1")
                    ->andWhere("prod.abbreviation = 'DDG'")
                    ->orWhere("prod.nomproduit = 'Dépôts de garantie' ");
            },
            'choice_label' => function ($c) {
                return $c->getCodeepargne();
            },
            'attr'=>[
                'class' => 'form-control border-0 custom-select-no-arrow',
            ],
            'label' => "Compte epargne client  : ",
            'placeholder' => "Choisissez le compte epargne  :",
            'autocomplete' => true,
        ])
        
        ->getForm();
        $form->handleRequest($request);
    
        /* ===== Si les produits sont selectionnnés. On va executer les requests ci-dessous ====== */
        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData()['code'];
            $status = "depot_garantie_entree";
            return $this->redirectToRoute('app_transaction_new', ['code' => $data,'status' => $status],Response::HTTP_SEE_OTHER);
        }

        return $this->render('Module_epargne/transaction/infoTransaction/depot_garantie_entree.html.twig',[
            'form' => $form->createView(),
        ]);
    }

            //Compte epargne individuel client
    /**
     * Entree depot de garantie
     *
     * @param Request $request
     * @return void
     */ 
    #[Route('/depot/garantie/sortie', name: 'app_depot_de_garantie_sortie')]
    public function depot_de_garantie_sortie(Request $request)
    {
        $form = $this->createFormBuilder()
        ->add('code', EntityType::class,[
            'class' => CompteEpargne::class,
            'query_builder' => function (CompteEpargneRepository $er) {
                return $er->createQueryBuilder('c')
                    ->join("c.produit","prod")
                    ->where("c.activated = 1")
                    ->andWhere("prod.abbreviation = 'DDG'")
                    ->orWhere("prod.nomproduit = 'Dépôts de garantie' ");
            },
            'choice_label' => function ($c) {
                return $c->getCodeepargne();
            },
            'attr'=>[
                'class' => 'form-control border-0 custom-select-no-arrow',
            ],
            'label' => "Compte epargne client  : ",
            'placeholder' => "Choisissez le compte epargne  :",
            'autocomplete' => true,
        ])
        
        ->getForm();
        $form->handleRequest($request);
    
        /* ===== Si les produits sont selectionnnés. On va executer les requests ci-dessous ====== */
        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData()['code'];

            // dd($data);
            $status = "depot_garantie_sortie";
            return $this->redirectToRoute('app_retrait', ['code' => $data,'status' => $status],Response::HTTP_SEE_OTHER);
        }

        return $this->render('Module_epargne/transaction/infoTransaction/depot_garantie_sortie.html.twig',[
            'form' => $form->createView(),
        ]);
    }
}