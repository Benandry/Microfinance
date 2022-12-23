<?php

namespace App\Controller\Credit;

use App\Entity\DemandeCredit;
use App\Entity\AmortissementFixe;
use App\Form\DemandeCreditType;
use App\Repository\DemandeCreditRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

#[Route('/demande/credit')]
class DemandeCreditController extends AbstractController
{
    #[Route('/', name: 'app_demande_credit_index', methods: ['GET'])]
    public function index(DemandeCreditRepository $demandeCreditRepository): Response
    {
        return $this->render('demande_credit/index.html.twig', [
            'demande_credits' => $demandeCreditRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_demande_credit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DemandeCreditRepository $demandeCreditRepository,ManagerRegistry $doctine ): Response
    {
        $demandeCredit = new DemandeCredit();
        $form = $this->createForm(DemandeCreditType::class, $demandeCredit);
        $form->handleRequest($request);

        $user = $this->getUser();
       // $roles = $user->getRoles();
        //dd($roles);
        
        if ($form->isSubmitted() && $form->isValid()) {

           $data = $form->getData();
           $montant = $demandeCredit->getMontant();
           $tranche =  $demandeCredit->getNombreTranche();
           $taux =  $demandeCredit->getTauxInteretAnnuel();
           $codeclient =  $demandeCredit->getCodeclient();
           $demandeCredit->setStatusApp("en attente ");
           $codecredit = $demandeCredit->getNumeroCredit();

           //dd($data->getTypeAmortissement() );

           //dd($data->getTypeAmortissement());
           $demandeCreditRepository->add($demandeCredit, true);


           if($data->getTypeAmortissement() == "simple")
           {

                /******************************Amortissement simple ******************* */
                $dateRemb = date('Y/m/d');
                $capitalDu = $montant / $tranche;
                $interetTotal = $montant*($taux/100);
                $interet = $interetTotal / $tranche;
                $netPayer = $capitalDu + $interet;

                $tableau_amort = [ 
                        [
                            'periode' => 1, 
                            'dateRemb' => $dateRemb,
                            'CapitalDu' =>$capitalDu,
                            "interet" => $interet,
                            "montantPayer" =>$netPayer,
                            'codeclient' => $codeclient,
                            'codecredit' => $codecredit
                        ],  
                    ];

                for ( $i = 1 ; $i < $tranche ; $i++ ) {
                    $dateRemb =  date("Y-m-d", strtotime($dateRemb.'+ 1 month'));
                    array_push($tableau_amort,[
                        'periode'=> $i+1,
                        'dateRemb'=>$dateRemb,
                        'CapitalDu'=>$capitalDu,
                        'interet'=>$interet,
                        'montantPayer'=>$netPayer,
                        'codeclient' => $codeclient,
                        'codecredit' => $codecredit,
                    ]);
                }
                
                $entityManager = $doctine->getManager();
                for ($i=0; $i < $tranche; $i++) { 
                    $amortissement = new AmortissementFixe();
                    $amortissement->setDateRemborsement(date_create($tableau_amort[$i]['dateRemb']));
                    $amortissement->setPrincipale($tableau_amort[$i]['CapitalDu']);
                    $amortissement->setInteret($tableau_amort[$i]['interet']);
                    $amortissement->setMontanttTotal($tableau_amort[$i]['montantPayer']);
                    $amortissement->setPeriode($tableau_amort[$i]['periode']);
                    $amortissement->setCodeclient($codeclient);
                    $amortissement->setCodecredit($codecredit);
                    $amortissement->setTypeamortissement('simple');
                    
                    $entityManager->persist($amortissement);
                    $entityManager->flush();
                }
                //dd($tableau_amort);
                return $this->redirectToRoute('app_tableau_amortissement', [
                    'codecredit' => $codecredit,
                    'montant' => $montant,
                    'tranche' => $tranche,
                    'taux' => $taux,
                ], Response::HTTP_SEE_OTHER);
           }
            /************************************************************************************ */

            /************************************** Amortissement par annuite constante ********************************************** */


           elseif($data->getTypeAmortissement() == "anuuite constante")
           {
            
                    
                $tauxInteret  = $taux / 100;
                $annuite_constante = $montant *( $tauxInteret /(1-pow((1 + $tauxInteret),(-$tranche))));
                // dd("Taux est ".$annuite_constante);
            
                $tableau_amortissement = [];
                
                $dateRemb = date('Y/m/d');
                $capitalRestantDu = $montant;
                $interet = $capitalRestantDu * $tauxInteret;
                $amortissement = $annuite_constante - $interet;
            
            
                //Annuite constante
                $tableau_amortissement = [ 
                    [
                        'periode' => 1,
                        'dateRemb'=> $dateRemb ,
                        'capitalRestantDu' => $capitalRestantDu, 
                        "interet" => $interet,
                        'remboursement' => $amortissement,
                        'annuite' => $annuite_constante,
                    ], 
                ];
            
                for ( $i = 1; $i < $tranche ; $i++ ) {
                        //capital restant du
                        $capitalRestantDu = $capitalRestantDu - $amortissement;
                        //interet pour les restant
                        $interet = $capitalRestantDu * $tauxInteret;
                        //amortissement restant
                        $amortissement = $annuite_constante - $interet;
                        $dateRemb = date("Y-m-d", strtotime($dateRemb.'+ 1 month'));
                        array_push($tableau_amortissement,[
                            'periode'=> $i+1,
                            'dateRemb' => $dateRemb ,
                            'capitalRestantDu' => $capitalRestantDu,
                            "interet" => $interet,
                            'remboursement' => $amortissement,
                            'annuite' => $annuite_constante,
                        ]);
                }
            
               //dd($tableau_amortissement);

                $entityManager = $doctine->getManager();
                for ($i=0; $i < $tranche; $i++) { 
                    $amortissement = new AmortissementFixe();
                    $amortissement->setDateRemborsement(date_create($tableau_amortissement[$i]['dateRemb']));
                    $amortissement->setPrincipale($tableau_amortissement[$i]['capitalRestantDu']);
                    $amortissement->setInteret($tableau_amortissement[$i]['interet']);
                    $amortissement->setRemboursement($tableau_amortissement[$i]['remboursement']);
                    $amortissement->setAnnuite($tableau_amortissement[$i]['annuite']);
                    $amortissement->setPeriode($tableau_amortissement[$i]['periode']);
                    $amortissement->setCodeclient($codeclient);
                    $amortissement->setCodecredit($codecredit);
                    $amortissement->setTypeamortissement('anuuite constante');
                    
                    $entityManager->persist($amortissement);
                    $entityManager->flush();
                }
                return $this->redirectToRoute('app_tableau_amortissement_annuite_constante', [
                    'codecredit' => $codecredit,
                ], Response::HTTP_SEE_OTHER);
           }

           elseif($data->getTypeAmortissement() == "amortissement constante") 
           {

                /**
                 * Formule amortissement constante est A = capital/periode
                 */
                $k = 25000;
                $t = 5;
                $taux = 0.06;
                $amortissement_constante = $k / $t;
                $interet = $k *$taux;
                $annuite = $amortissement_constante + $interet;

                /***
                * Etablissement du tableau d’amortissement
                */
                $dateRemb = date('Y/m/d');
                // $capitalRestantDu = $montant;
                // $interet = $capitalRestantDu * $tauxInteret;
                // $amortissement = $annuite_constante - $interet;

                $tableau_amortissement = [
                    [
                        'periode' => 1,
                        'dateRemboursement' => $dateRemb,
                        'capitalRestantDu' => $k,
                        'interet' => $interet,
                        'remboursement' => $amortissement_constante,
                        'annuite' => $annuite,
                    ]
                ];

                for ($i=0; $i < $t; $i++) { 
                    $k = $k - $amortissement_constante;
                    $interet = $k * $taux;
                    $annuite = $amortissement_constante + $interet;

                    array_push($tableau_amortissement,[
                        'periode' => $i+1,
                        'dateRemboursement' => $dateRemb,
                        'capitalRestantDu' => $k,
                        'interet' => $interet,
                        'remboursement' => $amortissement_constante,
                        'annuite' => $annuite,
                    ]);
                }


                
                dd($tableau_amortissement);

                return $this->redirectToRoute('app_tableau_amortissement_remboursement_constante', [
                    'montant' => $montant,
                    'tranche' => $tranche,
                    'taux' => $taux,
                    'codeclient' => $codeclient,
                ], Response::HTTP_SEE_OTHER);
           }
           
           
        }

        // Recupere la derniere ID pour creer la numero credit

        $numeroCredit=$demandeCreditRepository->DernierNumeroCredit();

        if($numeroCredit[0][1] == NULL){
            $numero = 0;
        }
        else{
            $numero=$numeroCredit[0][1];
        }


        return $this->renderForm('demande_credit/new.html.twig', [
            'demande_credit' => $demandeCredit,
            'numeros'=>$numero,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demande_credit_show', methods: ['GET'])]
    public function show(DemandeCredit $demandeCredit): Response
    {
        return $this->render('demande_credit/show.html.twig', [
            'demande_credit' => $demandeCredit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_demande_credit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DemandeCredit $demandeCredit, DemandeCreditRepository $demandeCreditRepository): Response
    {
        $form = $this->createForm(DemandeCreditType::class, $demandeCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $demandeCreditRepository->add($demandeCredit, true);

            return $this->redirectToRoute('app_demande_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('demande_credit/edit.html.twig', [
            'demande_credit' => $demandeCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demande_credit_delete', methods: ['POST'])]
    public function delete(Request $request, DemandeCredit $demandeCredit, DemandeCreditRepository $demandeCreditRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demandeCredit->getId(), $request->request->get('_token'))) {
            $demandeCreditRepository->remove($demandeCredit, true);
        }

        return $this->redirectToRoute('app_demande_credit_index', [], Response::HTTP_SEE_OTHER);
    }
}
