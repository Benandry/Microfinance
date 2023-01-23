<?php

namespace App\Controller\Module_epargne\InfoCompte;

use App\Controller\Comptabilite\TraitementCompta\MouvementEpargne;
use App\Entity\Transaction;
use App\Form\TransactionType;
use App\Repository\TransactionRepository;
use Doctrine\Persistence\ManagerRegistry;
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
                return $this->redirectToRoute('app_transaction_groupe_depot', [
                        'code' => $code,
                        'nom' => $nom,
                        'email' => $email,
                        'code_groupe' => $code_groupe
    
                    ], 
                Response::HTTP_SEE_OTHER);
            }
    
            return $this->render('Module_epargne/compte_epargne/infoCompte/depot_groupe.html.twig',[
                'nom' => ' ',
                'form' => $form->createView(),
            ]);
        }

            // Nouveau depot
    #[Route('/depotgroupe', name: 'app_transaction_groupe_depot', methods: ['GET', 'POST'])]

    public function DepotGroupe(ManagerRegistry $doctrine,Request $request, TransactionRepository $transactionRepository,MouvementEpargne $mouvement)
    {
        $transaction = new Transaction();

        $code = $request->query->get('code');
        $nomgroupe = $request->query->get('nom');
        $email = $request->query->get('email');

        // dd($nomgroupe,$code,$email);

        $soldeCurrent = $transactionRepository->soldeCurrent($code);
        // dd($soldeCurrent);

        if($soldeCurrent == null ){
            $soldeCurrent[0]['solde'] = 0;
        }

    //    dd($soldeCurrent);
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $refTransac = random_int(2,1000000000);
            $transaction->setCodetransaction($refTransac);
            $entityManager=$doctrine->getManager();
            $debit = $form->get('debit')->getData();
            $credit = $form->get('credit')->getData();
            $mouvement->operationJournal($entityManager,$transaction,$debit,$credit);
            
            // $transactionRepository->add($transaction,true);

            $codeclient=$transaction->getCodeepargneclient();
            // dd($codeclient);
            $transaction->setCodeepargneclient($codeclient);

            // setCodeepargneclient(string $codeepargneclient)

            $Description=$transaction->getDescription();
            $transaction->setDescription($Description);

            $PieceComptable=$transaction->getPieceComptable();
            $transaction->setPieceComptable($PieceComptable);

            $DateTransaction=$transaction->getDateTransaction();
            $transaction->setDateTransaction($DateTransaction);

            $Montant=$transaction->getMontant();
            $transaction->setMontant($Montant);

            $Papeterie=$transaction->getPapeterie();
            $transaction->setPapeterie($Papeterie);

            $Commission=$transaction->getCommission();
            $transaction->setCommission($Commission);

            $TypeClient=$transaction->getTypeClient();
            $transaction->setTypeClient($TypeClient);

            $solde=$transaction->getSolde();

            if ($solde == "NaN") {
                $transaction->setSolde($Montant);
            }else{
                $transaction->setSolde($solde);
            }
            

            $entityManager->persist($transaction);
            $entityManager->flush();

            $this->addFlash('success', " Dépot réussite du compte epargne groupe " .$transaction->getCodeepargneclient()." . réference : ".$transaction->getCodetransaction());

            return $this->redirectToRoute('app_transaction_groupe_depot', [
                'code' => $code,
                'nom' => $nomgroupe,
                'email' => $email,
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_epargne/transaction/depotgroupe.html.twig', [
            'transaction' => $transaction,
            'form' => $form,
            'codegroupe' => $code,
            'nomgroupe' => $nomgroupe,
            'email' => $email,
        'solde' => $soldeCurrent[0]['solde'],
        ]);
    }

    // modal retrait groupe

    #[Route('/transaction/retrait/groupe',name:'app_transaction_retrait_groupe')]
    public function RetraitGroupe(Request $request):Response
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

        ->add('submit', SubmitType::class,[
            'label' => 'Valider',
            'attr' => [
                'class' => 'btn btn-primary btn-sm'
            ]
        ])
        ->getForm();
    
        $form->handleRequest($request);
        
        /* ===== Si le code groupe sont ecrites ,on va passer a la requete suivante ====== */
        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $code = $data['code'];
            $nom = $data['nom'];
            return $this->redirectToRoute('app_transaction_retrait', [
                    'code' => $code,
                    'nom' => $nom,

                ], 
            Response::HTTP_SEE_OTHER);
        }

        return $this->render('Module_epargne/compte_epargne/infoCompte/retrait_groupe.html.twig',[
            'nom' => 'Nandrianina ',
            'form' => $form->createView(),
        ]);
    }

    // Retrait individuel

         #[Route('/transaction/retrait/individuel', name: 'app_retrait_individuel')]

         public function RetraitIndividuel(Request $request){
    
            
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
                $code_client  = $data['code_client'];
                $produit = $data['produit'];
                $nom = $data['nom'];
                $prenom = $data['prenom'];

                return $this->redirectToRoute('app_retrait', [
                    'code' => $code,
                    'cod_client' => $code_client,
                    'code' => $code,
                    'nom' => $nom,
                    'prenom' => $prenom,
    
                    ], 
                Response::HTTP_SEE_OTHER);
            }
    
             //dd("Compte epargne groupe");
             return $this->render('Module_epargne/compte_epargne/infoCompte/retrait_individuel.html.twig',[
                'form' => $form->createView(),
             ]);
         }
    


}