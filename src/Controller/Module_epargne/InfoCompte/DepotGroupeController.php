<?php

namespace App\Controller\Module_epargne\InfoCompte;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DepotGroupeController extends AbstractController
{

        //Compte epargne individuel client
        #[Route('/depot/epargne/groupe', name: 'app_depot_epargne_groupe')]
        public function ouvrirCompteEpargnr(Request $request)
        {
    
            $form = $this->createFormBuilder()
            ->add('code', TextType::class,[
                'label' => "Compte epargne groupe : ",
                'attr' =>[
                    'class' => 'form-control',
                ]
            ])
            ->add('nom', TextType::class,[
                'label' => "Nom du groupe : ",
                'attr' =>[
                    'class' => 'form-control',
                ]
            ])

            ->add('code_groupe', TextType::class,[
                'label' => "code du groupe : ",
                'attr' =>[
                    'class' => 'form-control',
                ]
            ])

            ->add('email', TextType::class,[
                'label' => "Email du groupe : ",
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
                $code = $data['code'];
                $nom = $data['nom'];
                $email = $data['email'];
                $code_groupe = $data['code_groupe'];
                return $this->redirectToRoute('app_transaction_new', [
                        'code' => $code,
                        'nom' => $nom,
                        'email' => $email,
                        'code_groupe' => $code_groupe
    
                    ], 
                Response::HTTP_SEE_OTHER);
            }
    
            return $this->render('Module_epargne/compte_epargne/infoCompte/depot_groupe.html.twig',[
                'nom' => 'Nandrianina ',
                'form' => $form->createView(),
            ]);
        }
}