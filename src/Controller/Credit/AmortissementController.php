<?php

namespace App\Controller\Credit;

use App\Entity\AmortissementFixe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\DateTime;

class AmortissementController extends AbstractController
{


    ///Amortissement Lineaire
    #[Route('/demande/tableau/amortissement', name: 'app_tableau_amortissement')]
    public function lineaire(Request $request,ManagerRegistry $doctrine): Response
    {
        $montant = $request->query->get('montant');
        $tranche = $request->query->get('tranche');
        $tauxInteret = $request->query->get('taux');
        $codeclient = $request->query->get('codeclient');

        $dateRemb = date('Y/m/d');
        $capitalDu = $montant / $tranche;
        $interetTotal = $montant*($tauxInteret/100);
        $interet = $interetTotal / $tranche;
        $netPayer = $capitalDu + $interet;

        $tableau_amort = [ ['periode' => 0, 'dateRemb' => $dateRemb,'CapitalDu' =>$capitalDu,"interet" => $interet,"montantPayer" =>$netPayer], ];

        for ( $i = 1; $i < $tranche ; $i++ ) {
            $dateRemb =  date("Y-m-d", strtotime($dateRemb.'+ 1 month'));
            array_push($tableau_amort,['periode'=> $i,'dateRemb'=>$dateRemb,'CapitalDu'=>$capitalDu,'interet'=>$interet,'montantPayer'=>$netPayer]);
        }
       //dd($tableau_amort);

        //    dd($tauxInteret);
        $sumMontant = array_sum(array_column($tableau_amort,'CapitalDu'));
        $sumInteret = array_sum(array_column($tableau_amort,'interet'));
        $sumNet = array_sum(array_column($tableau_amort,'montantPayer'));

        // dd($sumInteret);
        $form = $this->createFormBuilder()
            ->add('submit', SubmitType::class,[
                'label' => 'Suivant ',
                'attr' => [
                    'class' => 'btn btn-primary btn-sm'
                ]
            ])
            ->getForm();

            $entityManager = $doctrine->getManager();

    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()){
            for ($i=0; $i < $tranche; $i++) { 
                $amortissement = new AmortissementFixe();
                $amortissement->setDateRemborsement(date_create($tableau_amort[$i]['dateRemb']));
                $amortissement->setPrincipale($tableau_amort[$i]['CapitalDu']);
                $amortissement->setInteret($tableau_amort[$i]['interet']);
                $amortissement->setMontanttTotal($tableau_amort[$i]['montantPayer']);
                $amortissement->setPeriode($tableau_amort[$i]['periode']);
                $amortissement->setCodeclient($codeclient);
                
                $entityManager->persist($amortissement);
                $entityManager->flush();
            }
                
           // dd("Fin d'ajout");
            $this->addFlash('success', "Terminée !!!!");

            return $this->redirectToRoute('app_approbation_credit', [], Response::HTTP_SEE_OTHER);

        }
        return $this->render('demande_credit/amortissement/index.html.twig', [
            'montant' => $montant,
            'tranche' => $tranche,
            'taux' => $tauxInteret,
            'amortissement' =>$tableau_amort,
            'totalMontant' => $sumMontant,
            'totalInteret' => $sumInteret,
            'totalNet' => $sumNet,
            'form' => $form->createView(),
            'codeclient' => $codeclient,
        ]);
    }

    
    ///Amortissement Lineaire
    #[Route('/demande/tableau/amortissement/annuite_constante', name: 'app_tableau_amortissement_annuite_constante')]
    public function annuite_constante(Request $request,ManagerRegistry $doctrine): Response
    {
        $montant = 25000;
        $periode = 5;
        $tauxInteret  = 0.06;

        // dd($montant * (0.06/(1-pow(1.06,-5))));

        // dd(25000*(0.06/1-pow(1.06,(-5))));

        //calculer annuite 
        $annuite_constante = $montant *( $tauxInteret /(1-pow((1 + $tauxInteret),(-$periode))));
       // dd("Taux est ".$annuite_constante);

       $tableau_amortissement = [];
       
       $dateRemb = date('Y/m/d');
       $capitalRestantDu = $montant;
       $interet = $capitalRestantDu * $tauxInteret;
       $amortissement = $annuite_constante - $interet;


       //Annuite constante
       $tableau_amortissement = [ ['periode' => 1,'capitalRestantDu' => $capitalRestantDu, "interet" => $interet,'remboursement' => $amortissement,'annuite' => $annuite_constante], ];

       for ( $i = 1; $i < $periode ; $i++ ) {
            //capital restant du
            $capitalRestantDu = $capitalRestantDu - $amortissement;
            //interet pour les restant
            $interet = $capitalRestantDu * $tauxInteret;
            //amortissement restant
            $amortissement = $annuite_constante - $interet;
            array_push($tableau_amortissement,['periode'=> $i+1,'capitalRestantDu' => $capitalRestantDu,"interet" => $interet,'remboursement' => $amortissement,'annuite' => $annuite_constante]);
       }

      // dd($tableau_amortissement);

       $sumMontant = array_sum(array_column($tableau_amortissement,'remboursement'));
       $sumInteret = array_sum(array_column($tableau_amortissement,'interet'));

       // return $this->redirectToRoute('app_demande_credit_new', [], Response::HTTP_SEE_OTHER);

       return $this->render('demande_credit/amortissement/degressive.html.twig', [
        'montant' => $capitalRestantDu,
        'periode' => $periode,
        'tauxInteret' => $tauxInteret,
        'annuite' => $annuite_constante,
        'tableau_amortissement' => $tableau_amortissement,
        'totalMontant' => $sumMontant,
        'totalInteret' => $sumInteret

       ]);
    }

     ///Amortissement Lineaire
     #[Route('/demande/tableau/amortissement/remboursement_constante', name: 'app_tableau_amortissement_remboursement_constante')]
     public function remboursement_constant(Request $request,ManagerRegistry $doctrine): Response
     {

     }

}
