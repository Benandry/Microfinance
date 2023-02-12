<?php

namespace App\Controller\Module_epargne\InfoCompte;

use App\Entity\CompteEpargne;
use App\Repository\CompteEpargneRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DepotGroupeController extends AbstractController
{

        //Compte epargne individuel client
        #[Route('/depot/epargne/groupe', name: 'app_depot_epargne_groupe')]
        public function ouvrirCompteEpargnr(Request $request)
        {
    
            $form = $this->createFormBuilder()
            ->add('code', EntityType::class,[
                'class' => CompteEpargne::class,
                'query_builder' => function (CompteEpargneRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->andWhere("c.typeClient = 'GROUPE' ");
                },
                'choice_label' => function ($c) {
                    return $c->getCodeepargne();
                },
                'label' => "Compte epargne client groupe : ",
                'placeholder' => "Choisissez le compte epargne groupe :",
                'autocomplete' => true,
            ])
           
            ->getForm();
            $form->handleRequest($request);
        
            /* ===== Si les produits sont selectionnnés. On va executer les requests ci-dessous ====== */
            if ($form->isSubmitted() && $form->isValid()){
                $data = $form->getData()['code'];
                return $this->redirectToRoute('app_transaction_groupe_depot', ['code' => $data],Response::HTTP_SEE_OTHER);
            }
    
            return $this->render('Module_epargne/compte_epargne/infoCompte/depot_groupe.html.twig',[
                'form' => $form->createView(),
            ]);
        }

    // modal retrait groupe

    #[Route('/transaction/retrait/groupe',name:'app_transaction_retrait_groupe')]
    public function RetraitGroupe(Request $request):Response
    {
        $form = $this->createFormBuilder()
        ->add('code', EntityType::class,[
            'class' => CompteEpargne::class,
            'query_builder' => function (CompteEpargneRepository $er) {
                return $er->createQueryBuilder('c')
                    ->andWhere("c.typeClient = 'GROUPE' ");
            },
            'choice_label' => function ($c) {
                return $c->getCodeepargne();
            },
            'label' => "Compte epargne client groupe : ",
            'placeholder' => "Choisissez le compte epargne groupe :",
            'autocomplete' => true,
        ])
        ->getForm();
    
        $form->handleRequest($request);
        
        /* ===== Si le code groupe sont ecrites ,on va passer a la requete suivante ====== */
        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData()['code'];
            return $this->redirectToRoute('app_transaction_retrait', ['code' => $data],Response::HTTP_SEE_OTHER);
        }

        return $this->render('Module_epargne/compte_epargne/infoCompte/retrait_groupe.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    // Retrait individuel

         #[Route('/transaction/retrait/individuel', name: 'app_retrait_individuel')]

         public function RetraitIndividuel(Request $request){
    
            
            $form = $this->createFormBuilder()
            ->add('code', EntityType::class,[
                'class' => CompteEpargne::class,
                'query_builder' => function (CompteEpargneRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->andWhere("c.typeClient = 'INDIVIDUEL' ");
                },
                'choice_label' => function ($c) {
                    return $c->getCodeepargne();
                },
                'label' => "Compte epargne client individuel : ",
                'placeholder' => "Choisissez le compte epargne individuel :",
                'autocomplete' => true,
            ])
            ->getForm();
        
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
                $data = $form->getData()['code'];
                return $this->redirectToRoute('app_retrait', ['code' => $data],Response::HTTP_SEE_OTHER);
            }
    
             //dd("Compte epargne groupe");
             return $this->render('Module_epargne/compte_epargne/infoCompte/retrait_individuel.html.twig',[
                'form' => $form->createView(),
             ]);
         }
    


}