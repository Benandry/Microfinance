<?php

namespace App\Controller\Credit;

use App\Entity\AmortissementFixe;
use App\Entity\ApprobationCredit;
use App\Entity\FicheDeCredit;
use App\Form\ApprobationCreditType;
use App\Repository\ApprobationCreditRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/approbation/credit')]
class ApprobationCreditController extends AbstractController
{
    #[Route('/individuel', name: 'app_approbation_credit_individuel', methods: ['GET'])]
    public function individuel(ApprobationCreditRepository $approbationCreditRepository): Response
    {
        $demandes = $approbationCreditRepository->findDemandeNonApprouver();
        //dd($demandes);
        
        return $this->render('Module_credit/approbation_credit/individuel.html.twig', [
            'demandes' => $demandes,
            'approbation_credits' => $approbationCreditRepository->findAll(),
        ]);
    }

    #[Route('/groupe', name: 'app_approbation_credit_groupe', methods: ['GET'])]
    public function groupe(ApprobationCreditRepository $approbationCreditRepository): Response
    {
        $demandes = $approbationCreditRepository->findDemandeNonApprouverGroupe();
        // dd($demandes);
        
        return $this->render('Module_credit/approbation_credit/groupe.html.twig', [
            'demandes' => $demandes,
            'approbation_credits' => $approbationCreditRepository->findAll(),
        ]);
    }

    #[Route('/Approbation/Ammortissement/',name:'app_ammortissement_approbation')]
    public function ApprobationAmmortissement(Request $request,EntityManagerInterface $entityManager){

        $DateApprobation = date('Y/m/d');
        $DateApprobation = date("Y-m-d", strtotime($DateApprobation.'+ 1 month'));

        $MontantApprouvee=$request->query->get('MontantApprouvee');
        $CodeClient=$request->query->get('CodeClient');
        $NumeroCredit=$request->query->get('NumeroCredit');
        $TauxInteretAnnuel=$request->query->get('TauxInteretAnnuel');
        $InteretAnnuel=$MontantApprouvee*($TauxInteretAnnuel/100);
        $Periode=$request->query->get('NombreTranche');
        $DateApprobation=$request->query->get('DateApprobation');

        // dd($CodeClient.' '.$NumeroCredit);

                // Calcul capital
                $Capital=$MontantApprouvee/$Periode;
                // Calcum Interet
                $Interet=$InteretAnnuel/$Periode;
                // Total credit
                $Credit=$Capital+$Interet;
                // Grand total
                $GrandTotalCredit=$MontantApprouvee+$InteretAnnuel;
                // Echeance
                $Echeance=$Credit;
                // Capital restant du
                $CapitalRD=$MontantApprouvee-$Capital;
                // Interet Restant du
                $IRD=$InteretAnnuel-$Interet;
                // Credit restant du
                $CRD=$GrandTotalCredit-$Echeance;
                
        
                // Stocker dans une tableau les donnees
                $tableau=[[
        
                    'periode'=>1,
                    'dateRemborsement'=>$DateApprobation,
                    'principale'=>$Capital,
                    'interet'=>$Interet,
                    'montanttTotal'=>$Echeance,
                    'soldedu'=>$CapitalRD,
                    'InteretDu'=>$IRD,
                    'MontantRestantDu'=>$CRD,
                    ]
                ];
                
                // Creation du tableau d'ammortissement

                // Somme des Capital
                $SommeCapital=$Capital;
                // Somme interet
                $SommeInteret=$Interet;
                // Somme credit
                $SommeCredit=$Echeance;
                for($i=1;$i < $Periode;$i++)
                {
                    // Date demande +1
                    // $DateDemande = date('Y/m/d');
                    $DateApprobation= date("Y-m-d", strtotime($DateApprobation.'+ 1 month'));
                    $CapitalRD-=$Capital;
                    $IRD-=$Interet;
                    $CRD-=$Echeance;
                    // Somme des Capital
                    $SommeCapital+=$Capital;
                    // Somme interet
                    $SommeInteret+=$Interet;
                    // Somme credit
                    $SommeCredit+=$Echeance;
        
                    array_push($tableau,[
                        'periode'=>$i+1,
                        'dateRemborsement'=>$DateApprobation,
                        'principale'=>$Capital,
                        'interet'=>$Interet,
                        'montanttTotal'=>$Echeance,
                        'soldedu'=>$CapitalRD,
                        'InteretDu'=>$IRD,
                        'MontantRestantDu'=>$CRD,
                        'SommeCapital'=>$SommeCapital,
                        'SommeInteret'=>$SommeInteret,
                        'SommeCredit'=>$SommeCredit
                        ]
                    );
                }

                for ($i=0; $i < $Periode; $i++) { 
                    $amortissement = new AmortissementFixe();
                    $amortissement->setDateRemborsement(date_create($tableau[$i]['dateRemborsement']));
                    $amortissement->setPrincipale($tableau[$i]['principale']);
                    $amortissement->setInteret($tableau[$i]['interet']);
                    $amortissement->setMontanttTotal($tableau[$i]['montanttTotal']);
                    $amortissement->setPeriode($tableau[$i]['periode']);
                    $amortissement->setCodeclient($CodeClient);
                    $amortissement->setCodecredit($NumeroCredit);
                    $amortissement->setTypeamortissement('Lineaire');
                    $amortissement->setSoldedu($tableau[$i]['soldedu']);
                    $amortissement->setMontantRestantDu($tableau[$i]['MontantRestantDu']);
                    $amortissement->setInteretDu($tableau[$i]['InteretDu']);
                    
                    $entityManager->persist($amortissement);
                    $entityManager->flush();
        
                } 

        // Retourner vers le template du tableau d'ammortissement
                
        return $this->render('Module_credit/approbation_credit/TableauAmmortissement.html.twig', [
            'codeclientdemande'=>$CodeClient,
            // 'TypeClientDemande'=>$TypeClientDemande,
            'MontantDemande'=>$MontantApprouvee,
            'InteretA'=>$TauxInteretAnnuel,
            'Periode' => $Periode,
            'DateDemande' =>$DateApprobation,
            'Capital' => $Capital,
            'Interet' => $Interet,
            'Echeance' => $Echeance,
            'CapitalRD'=>$CapitalRD,
            'IRD '=>$IRD,
            'CRD'=>$CRD,
            'codecredit' => $NumeroCredit,
            'SommeCapital'=>$SommeCapital,
            'SommeInteret'=>$SommeInteret,
            'SommeCredit'=>$SommeCredit,
            'tableau'=>$tableau
        ]);

    }

    #[Route('/new/individuel', name: 'app_approbation_credit_new_individuel', methods: ['GET', 'POST'])]
    public function newIndividuel(EntityManagerInterface $em,Request $request, ApprobationCreditRepository $approbationCreditRepository): Response
    {   

        // Recuperation des donnees venant du formulaire modal
        $CodeClient=$request->query->get('CodeClient');
        $Montant=$request->query->get('Montant');
        $NumeroCredit=$request->query->get('NumeroCredit');
        $Cycle=$request->query->get('Cycle');
        $TauxInteretAnnuel=$request->query->get('TauxInteretAnnuel');
        $NombreTranche=$request->query->get('NombreTranche');
        $TypeTranche=$request->query->get('TypeTranche');
        $NomClient=$request->query->get('NomClient');
        $PrenomClient=$request->query->get('PrenomClient');


        // $demande = $request->query->all();

        // $codeclient = $demande['demande']['codeclient'];
        // $cycles = $approbationCreditRepository->findCycle($codeclient)[0][1];
        $approbationCredit = new ApprobationCredit();

        // Fiche de credit
        $fichedecredit=new FicheDeCredit();

        $form = $this->createForm(ApprobationCreditType::class, $approbationCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Recuperation du montant approuvée par l'administrateur
            $MontantApprouvee=$approbationCredit->getMontant();
            $DateApprobation=$approbationCredit->getDateApprobation();

            $approbationCreditRepository->add($approbationCredit, true);

            // Fiche de credit
            $fichedecredit->setNumeroCredit($NumeroCredit);
            $fichedecredit->setDateTransaction($DateApprobation);
            $fichedecredit->setTransaction('Approbation');
            $fichedecredit->setCapital($MontantApprouvee);
            // interet
            $InteretDemande=($MontantApprouvee*($TauxInteretAnnuel/100));
            $fichedecredit->setInteret($InteretDemande);
            // Total
            $TotalCreditDemande=$InteretDemande+$MontantApprouvee;
            $fichedecredit->setTotal($TotalCreditDemande);

            $em->persist($fichedecredit);
            $em->flush();
        
        
            $this->addFlash('success', "Le demande de credit ".$approbationCredit->getCodecredit()." est ".$approbationCredit->getStatusApprobation());
            return $this->redirectToRoute('app_ammortissement_approbation',
             [
                'CodeClient'=>$CodeClient,
                'NumeroCredit'=>$NumeroCredit,
                'DateApprobation'=>$DateApprobation,
                'MontantApprouvee'=>$MontantApprouvee,
                'TauxInteretAnnuel'=>$TauxInteretAnnuel,
                'NombreTranche'=>$NombreTranche,

             ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_credit/approbation_credit/approIndividuel.html.twig', [
            'approbation_credit' => $approbationCredit,
            'CodeClient'=>$CodeClient,
            'Montant'=>$Montant,
            'NumeroCredit'=>$NumeroCredit,
            'Cycle'=>$Cycle,
            'NombreTranche'=>$NombreTranche,
            'TypeTranche'=>$TypeTranche,
            'NomClient' => $NomClient,
            'TauxInteretAnnuel'=>$TauxInteretAnnuel,
            'PrenomClient' =>$PrenomClient,
            'form' => $form,
        ]);
    }

    #[Route('/new/groupe', name: 'app_approbation_credit_new_groupe', methods: ['GET', 'POST'])]
    public function newGroupe(Request $request, ApprobationCreditRepository $approbationCreditRepository): Response
    {
        $demande = $request->query->all();
        // dd($demande);
        $codeclient = $demande['demande']['codeclient'];
        $cycles = $approbationCreditRepository->findCycle($codeclient)[0][1];
        
        $approbationCredit = new ApprobationCredit();
        $form = $this->createForm(ApprobationCreditType::class, $approbationCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $approbationCreditRepository->add($approbationCredit, true);
            $this->addFlash('success', "Le demande de credit ".$approbationCredit->getCodecredit()." est ".$approbationCredit->getStatusApprobation());
            return $this->redirectToRoute('app_approbation_credit_groupe', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_credit/approbation_credit/approGroupe.html.twig', [
            'approbation_credit' => $approbationCredit,
            'demandes' => $demande,
            'form' => $form,
            'cycle' =>$cycles,
        ]);
    }


    #[Route('/{id}', name: 'app_approbation_credit_show', methods: ['GET'])]
    public function show(ApprobationCredit $approbationCredit): Response
    {
        return $this->render('Module_credit/approbation_credit/show.html.twig', [
            'approbation_credit' => $approbationCredit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_approbation_credit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ApprobationCredit $approbationCredit, ApprobationCreditRepository $approbationCreditRepository): Response
    {
        $form = $this->createForm(ApprobationCreditType::class, $approbationCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $approbationCreditRepository->add($approbationCredit, true);

            return $this->redirectToRoute('app_approbation_credit_individuel', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_credit/approbation_credit/edit.html.twig', [
            'approbation_credit' => $approbationCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_approbation_credit_delete', methods: ['POST'])]
    public function delete(Request $request, ApprobationCredit $approbationCredit, ApprobationCreditRepository $approbationCreditRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$approbationCredit->getId(), $request->request->get('_token'))) {
            $approbationCreditRepository->remove($approbationCredit, true);
        }

        return $this->redirectToRoute('app_approbation_credit_individuel', [], Response::HTTP_SEE_OTHER);
    }
}
