<?php

namespace App\Controller\Credit;

use App\Entity\AmortissementFixe;
use App\Entity\ReechelonnementCredit;
use App\Form\ReechelonnementCreditType;
use App\Repository\ReechelonnementCreditRepository;
use App\Service\ReechelonnementService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReechelonnementController extends AbstractController
{


    #[Route('/Ammortissement/Reechelonner/',name: 'app_ammortissement_reechelonner')]
    public function AmmortissementReechelonner(EntityManagerInterface $entityManager,Request $request)
    {
        $DateDemande = date('Y/m/d');
        $DateDemande = date("Y-m-d", strtotime($DateDemande.'+ 1 month'));

        $codeclient=$request->query->get('codeclient');
        $NumeroCredit=$request->query->get('NumeroCredit');
        $ResteCredit=$request->query->get('ResteCredit');
        $ResteCapital=$request->query->get('ResteCapital');
        $ResteInteret=$request->query->get('ResteInteret');
        $Periode=$request->query->get('PeriodeDu');
        $DateDemande=$request->query->get('DateDemande');

        // dd($codeclient.' '.$NumeroCredit);


        // Echeance
        $Echeance=$ResteCredit/$Periode;
        // Capital
        $Capital=$ResteCapital/$Periode;
        // Interet
        $Interet=$ResteInteret/$Periode;

        // dd($Echeance.' '.$Capital.' '.$Interet);

        // Interet  restant du
        $IRD=$ResteInteret-$Interet;

        // Capital restant du
        $CapitalRD=$ResteCapital-$Capital;

        // Credit restant du
        $CRD=$ResteCredit-$Echeance;

        // Somme credit
        $SommeCredit=$Echeance;

        // Stocker dans une tableau les donnees
        $tableau=[[

            'periode'=>1,
            'dateRemborsement'=>$DateDemande,
            'principale'=>$Capital,
            'interet'=>$Interet,
            'montanttTotal'=>$Echeance,
            'soldedu'=>$CapitalRD,
            'InteretDu'=>$IRD,
            'MontantRestantDu'=>$CRD,
    ]
        ];

        // Somme capital
        $SommeCapital=$Capital;

        // Somme interet
        $SommeInteret=$Interet;
        
        // Creation du tableau d'ammortissement
        for($i=1;$i <$Periode;$i++)
        {
            // Date demande +1
            $DateDemande = date('Y/m/d');
            $DateDemande= date("Y-m-d", strtotime($DateDemande.'+ 1 month'));
            $CapitalRD-=$Capital;
            $IRD-=$Interet;
            $CRD-=$Echeance;

            $SommeCapital+=$Capital;
            $SommeInteret+=$Interet;
            $SommeCredit+=$Echeance;

            array_push($tableau,[
                'periode'=>$i+1,
                'dateRemborsement'=>$DateDemande,
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
            $amortissement->setCodeclient($codeclient);
            $amortissement->setCodecredit($NumeroCredit);
            $amortissement->setTypeamortissement('Lineaire');
            $amortissement->setSoldedu($tableau[$i]['soldedu']);
            $amortissement->setMontantRestantDu($tableau[$i]['MontantRestantDu']);
            $amortissement->setInteretDu($tableau[$i]['InteretDu']);
            
            $entityManager->persist($amortissement);
            $entityManager->flush();

        } 

                // Retourner vers le template du tableau d'ammortissement
                
                return $this->render('Module_credit/Reechelonnement/TableauAmmortissementReechelonner.html.twig', [
                    'codeclient'=>$codeclient,
                    // 'TypeClientDemande'=>$TypeClientDemande,
                    'ResteCredit'=>$ResteCredit,
                    'ResteInteret'=>$ResteInteret,
                    'Periode' => $Periode,
                    'DateDemande' =>$DateDemande,
                    'Capital' => $Capital,
                    'Interet' => $Interet,
                    'Echeance' => $Echeance,
                    'CapitalRD'=>$CapitalRD,
                    'IRD '=>$IRD,
                    'CRD'=>$CRD,
                    'NumeroCredit' => $NumeroCredit,
                    'SommeCapital'=>$SommeCapital,
                    'SommeInteret'=>$SommeInteret,
                    'SommeCredit'=>$SommeCredit,
                    'tableau'=>$tableau
                ]);
        

        // dd($tableau);

    }

    /**
     * Undocumented function
     *
     * @method mixed Reechelonnement():Reechelonnement credit
     * 
     * @method mixed Reechelonnement():Fonction permet de reechelonner les credits
     * @param Request $request
     * @return Response
     */
    #[Route('/Reechelonnment/Controller/Individuel/',name:'app_reechelonnement_controller')]
    public function Reechelonnement(ReechelonnementService $reechelonnement,EntityManagerInterface $em,Request $request,ReechelonnementCreditRepository $reechelonnementCreditRepository):Response
    {
        // Recuperer les donnees vient du modal
        $idclient=$request->query->get('CodeCredit');
        $nom=$request->query->get('nom');
        $prenom=$request->query->get('prenom');
        $codeclient=$request->query->get('codeclient');
        $NumeroCredit=$request->query->get('NumeroCredit');
        $SommeDejaRembourser=$request->query->get('SommeDejaRembourser');
        $MontantDecaisser=$request->query->get('MontantDecaisser');
        $InteretCredit=$request->query->get('InteretCredit');
        $Periode=$request->query->get('Periode');
        $DernierPeriode=$request->query->get('DernierPeriode');
        $CapitalRembourser=$request->query->get('ResteCapital');
        $InteretRembourser=$request->query->get('ResteInteret');

        // Total credit
        $TotalCredit=($MontantDecaisser*($InteretCredit/100))+$MontantDecaisser;
        // reste capital
        $ResteCapital=$MontantDecaisser-$CapitalRembourser;
        // Total Interet
        $TotalInteret=$MontantDecaisser*($InteretCredit/100);
        // reste Interet 
        $ResteInteret=$TotalInteret-$InteretCredit;
        // Reste Credit à rembourser
        $ResteCredit=(($MontantDecaisser*($InteretCredit/100))+$MontantDecaisser)-$SommeDejaRembourser;
        // Reste periode
        $PeriodeDu=$Periode-$DernierPeriode;

        // Instanciation reechelonnement credit
        $reechelonnement=new ReechelonnementCredit();

        // Creation formulaire pour le reechelonnement
        $form=$this->createForm(ReechelonnementCreditType::class,$reechelonnement);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // Recuperer les donnees venant du modal
            // $data=$form->getData();

            $datedujour=$reechelonnement->getDateDuJour();
            $DateDemande=$reechelonnement->getDateReechelonner();

            $reechelonnement->setDateDuJour($datedujour);
            $reechelonnement->setNumeroCredit($NumeroCredit);
            $reechelonnement->setCodeClient($codeclient);
            $reechelonnement->setResteCredit($ResteCredit);
            $reechelonnement->setRestePeriode($PeriodeDu);
            $reechelonnement->setResteCapital($ResteCapital);
            $reechelonnement->setResteInteret($ResteInteret);
            $reechelonnement->setDateReechelonner($DateDemande);
            
            $em->persist($reechelonnement);
            $em->flush();    

            return $this->redirectToRoute('app_ammortissement_reechelonner',[

                'codeclient'=>$codeclient,
                'NumeroCredit'=>$NumeroCredit,
                'ResteCredit'=>$ResteCredit,
                'ResteCapital'=>$ResteCapital,
                'ResteInteret'=>$ResteInteret,
                'PeriodeDu'=>$PeriodeDu,
                'DateDemande'=>$DateDemande
            ]);
            
            // $reechelonnement->Reechelonner($ResteCredit,$ResteCapital,$ResteInteret,$PeriodeDu,$DateDemande);
        }
        // Nouveau tableau ammortissement reechelonner


        //  $this->addFlash('success','Reechelonnement Avec succes');
            
            // dd($datedujour);
            return $this->renderForm('Module_credit/Reechelonnement/Reechelonnement.html.twig',[
                'nom'=>$nom,
                'prenom'=>$prenom,
                'codeclient'=>$codeclient,
                'NumeroCredit'=>$NumeroCredit,
                'TotalCredit'=>$TotalCredit,
                'ResteCredit'=>$ResteCredit,
                'PeriodeDu'=>$PeriodeDu,
                'form'=>$form
            ]);
        }
    }