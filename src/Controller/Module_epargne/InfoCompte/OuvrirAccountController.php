<?php

namespace App\Controller\Module_epargne\InfoCompte;

use App\Entity\CompteEpargne;
use App\Entity\Groupe;
use App\Entity\Individuelclient;
use App\Repository\CompteEpargneRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OuvrirAccountController extends AbstractController
{
    /**
     * Compte epargne individuel client
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
                'placeholder' => "Choisissez l'ndividuel client :",
                'choice_label' => function($client){
                    return $client->getNomClient()." ".$client->getPrenomClient();
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
     * Ouvrir compte epargne en groupe
     *
     * @param Request $request
     * @return void
     */
     #[Route('/ouvrir/CompteEpargne/Groupe', name: 'app_ouvrir_compte_groupe')]
     public function compteEpargneGroup(Request $request){
        $form = $this->createFormBuilder()
        ->add('code', EntityType ::class,[
                'class' => Groupe:: class,
                'label' => 'Groupe client : ',
                'placeholder' => "Choisissez le groupe :",
                'choice_label' => function($c){
                    return $c->getNomGroupe();
                },
                'attr'=>[
                    'class' => 'form-control border-0 custom-select-no-arrow',
                ],
                'autocomplete' => true,
        ])
        ->getForm();

        // dd("tonga ato aloaha");
    
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData()['code'];
            return $this->redirectToRoute('app_compte_epargne_new_groupe', ['code' => $data], Response::HTTP_SEE_OTHER);
        }

         //dd("Compte epargne groupe");
         return $this->render('Module_epargne/compte_epargne/infoCompte/ouvrir_groupe.html.twig',[
            'form' => $form->createView(),
         ]);
     }


     
     ///Compte epargne Depot  

     /**
      * Entree Depot a Vue
      *
      * @param Request $request
      * @return void
      */
     #[Route('/CompteEpargneDepot', name: 'app_compte_epargne_depot')]
     public function compteEpargneDepot(Request $request){

        // dd( new CompteEpargne);
        
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
            return $this->redirectToRoute('app_transaction_new', ['code' => $data],Response::HTTP_SEE_OTHER);
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
      public function sortie(Request $request){
 
         // dd( new CompteEpargne);
         
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
             return $this->redirectToRoute('app_retrait', ['code' => $data],Response::HTTP_SEE_OTHER);
         }
 
          return $this->render('Module_epargne/transaction/infoTransaction/depot_a_vue_sortie.html.twig',[
             'form' => $form->createView(),
          ]);
      }
}