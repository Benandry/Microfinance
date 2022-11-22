<?php

namespace App\Controller\Module_epargne\InfoCompte;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OuvrirAccountController extends AbstractController
{
    //Compte epargne individuel client
    #[Route('/ouvrirCompteEpargneClient', name: 'app_ouvrir_compte_epargne')]
    public function ouvrirCompteEpargnr(Request $request)
    {

        $form = $this->createFormBuilder()
        ->add('code', TextType::class,[
            'label' => "Code client a ouvrir un compte : ",
            'attr' =>[
                'class' => 'form-control',
                'maxlength' => 10,
                'minLength' => 10
            ]
        ])
        ->add('nom', TextType::class,[
            'label' => "Nom du client : ",
            'attr' =>[
                'class' => 'form-control',
            ]
        ])
        ->add('prenom', TextType::class,[
            'label' => "Prenom du client : ",
            'attr' =>[
                'class' => 'form-control',
            ]
        ])

        ->add('submit', SubmitType::class,[
            'label' => 'Valider',
            'attr' => [
                'class' => 'btn btn-primary btn-sm'
            ]
        ])
        ->getForm();
    
        $form->handleRequest($request);
    
        /* ===== Si les produits sont selectionnnés. On va executer les requests ci-dessous ====== */
        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            /*****Inforamtion via lees formulaire************************ */
            $code = $data['code'];
            $nom = $data['nom'];
            $prenom = $data['prenom'];
            return $this->redirectToRoute('app_compte_epargne_new', [
                    'code' => $code,
                    'nom' => $nom,
                    'prenom' => $prenom,

                ], 
            Response::HTTP_SEE_OTHER);
        }

        return $this->render('Module_epargne/compte_epargne/infoCompte/ouvrir.html.twig',[
            'nom' => 'Nandrianina ',
            'form' => $form->createView(),
        ]);
    }

     ///Compte epargne groupeb  

     #[Route('/ouvrirCompteEpargneEpargneGroupe', name: 'app_ouvrir_compte_groupe')]
     public function compteEpargneGroup(Request $request){

        
        $form = $this->createFormBuilder()
        ->add('code', TextType::class,[
            'label' => "Code groupe a ouvrir un compte : ",
            'attr' =>[
                'class' => 'form-control',
                'maxlength' => 10,
                'minLength' => 10
            ]
        ])
        ->add('nomgroupe', TextType::class,[
            'label' => "Nom du groupe : ",
            'attr' =>[
                'class' => 'form-control',
            ]
        ])
        ->add('email', TextType::class,[
            'label' => "Adresse email : ",
            'attr' =>[
                'class' => 'form-control',
            ]
        ])

        ->add('submit', SubmitType::class,[
            'label' => 'Valider',
            'attr' => [
                'class' => 'btn btn-primary btn-sm'
            ]
        ])
        ->getForm();
    
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            //dd($data);
            /*****Inforamtion via lees formulaire************************ */
            $code = $data['code'];
            $nom = $data['nomgroupe'];
            $email = $data['email'];
            return $this->redirectToRoute('app_compte_epargne_new_groupe', [
                    'code' => $code,
                    'nom' => $nom,
                    'email' => $email,

                ], 
            Response::HTTP_SEE_OTHER);
        }

         //dd("Compte epargne groupe");
         return $this->render('Module_epargne/compte_epargne/infoCompte/ouvrir_groupe.html.twig',[
            'form' => $form->createView(),
         ]);
     }


     
     ///Compte epargne Depot  

     #[Route('/CompteEpargneDepot', name: 'app_compte_epargne_depot')]
     public function compteEpargneDepot(Request $request){

        
        $form = $this->createFormBuilder()
        ->add('code', TextType::class,[
            'label' => "Compte epargne client  : ",
            'attr' =>[
                'class' => 'form-control',
                'maxlength' => 15,
                'minLength' => 15
            ]
        ])
        ->add('code_client', TextType::class,[
            'label' => "Code client : ",
            'attr' =>[
                'class' => 'form-control',
            ]
        ])

        ->add('produit', TextType::class,[
            'label' => "Produit : ",
            'attr' =>[
                'class' => 'form-control',
            ]
        ])
        ->add('nom', TextType::class,[
            'label' => "Nom du client : ",
            'attr' =>[
                'class' => 'form-control',
            ]
        ])

        ->add('prenom', TextType::class,[
            'label' => "Preno, du client : ",
            'attr' =>[
                'class' => 'form-control',
            ]
        ])

        ->add('submit', SubmitType::class,[
            'label' => 'Valider',
            'attr' => [
                'class' => 'btn btn-primary btn-sm'
            ]
        ])
        ->getForm();
    
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            #dd($data);
            /*****Inforamtion via lees formulaire************************ */
            $code = $data['code'];
            $nom = $data['nom'];
            $email = $data['prenom'];
            return $this->redirectToRoute('app_transaction_new', [
                    'code' => $code,
                    'nom' => $nom,
                    'prenom' => $email,

                ], 
            Response::HTTP_SEE_OTHER);
        }

         //dd("Compte epargne groupe");
         return $this->render('Module_epargne/transaction/infoTransaction/depot.html.twig',[
            'form' => $form->createView(),
         ]);
     }
}