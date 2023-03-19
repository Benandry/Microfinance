<?php

namespace App\Controller\Credit;

use App\Controller\Credit\AmortissementTraitement\TraitementAmortissement as AmortissementTraitementTraitementAmortissement;
use App\Entity\DemandeCredit;
use App\Entity\AmortissementFixe;
use App\Form\DemandeCreditType;
use App\Repository\DemandeCreditRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Controller\Credit\TypeAmortissement\Types;
use App\Entity\PatrimoineCredit;
use App\Form\PatrimoineCreditType;
use App\Repository\PatrimoineCreditRepository;
use App\Service\TableauAmmortissementDemandeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

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

    #[Route('/ammortissement/Demande/',name: 'app_ammortissement')]
    public function AmmortissementDemandeCredit(TableauAmmortissementDemandeService $service,DemandeCreditRepository $demandeCreditRepository,Request $request)
    {   

        
        $data=new DemandeCredit();
        
        $DateDemande = date('Y/m/d');
        $DateDemande = date("Y-m-d", strtotime($DateDemande.'+ 1 month'));
        $codecredit=$request->query->get('codecredit');
        $codeclientdemande=$request->query->get('codeclientdemande');
        $TypeClientDemande=$request->query->get('TypeClientDemande');
        $DateDemande=$request->query->get('DateDemande');
        $MontantDemande=$request->query->get('MontantDemande');
        $InteretA=$request->query->get('InteretAnnuel');
        $InteretAnnuel=$MontantDemande*($InteretA/100);
        $Periode=$request->query->get('Periode');
        $TypeTranche=$request->query->get('TypeTranche');

        /**
         * Creation de la tableau d'ammortissement
         */


        // Calcul capital
        $Capital=$MontantDemande/$Periode;
        // Calcum Interet
        $Interet=$InteretAnnuel/$Periode;
        // Total credit
        $Credit=$Capital+$Interet;
        // Echeance
        $Echeance=$Credit/$Periode;
        // Capital restant du
        $CapitalRD=$MontantDemande-$Capital;
        // Interet Restant du
        $IRD=$InteretAnnuel-$Interet;
        // Credit restant du
        $CRD=$Credit-$Echeance;

        // Stocker dans une tableau les donnees
        $tableau=[[

            'Periode'=>1,
            'DateDemande'=>$DateDemande,
            'Capital'=>$Capital,
            'Interet'=>$Interet,
            'Echeance'=>$Echeance,
            'CapitalRD'=>$CapitalRD,
            'IRD'=>$IRD,
            'CRD'=>$CRD,
            ]
        ];
        
        // Creation du tableau d'ammortissement
        for($i=1;$i < $Periode;$i++)
        {
            // Date demande +1
            // $DateDemande = date('Y/m/d');
            $DateDemande= date("Y-m-d", strtotime($DateDemande.'+ 1 month'));
            $CapitalRD-=$Capital;
            $IRD-=$Interet;
            $CRD-=$Echeance;

            array_push($tableau,[
                'Periode'=>$i+1,
                'DateDemande'=>$DateDemande,
                'Capital'=>$Capital,
                'Interet'=>$Interet,
                'Echeance'=>$Echeance,
                'CapitalRD'=>$CapitalRD,
                'IRD'=>$IRD,
                'CRD'=>$CRD,
                ]
            );
        }

        // dd($tableau);


        // // dd($NumeroCredit);
        // $infodemandegroupe=$demandeCreditRepository->Ammortissement($NumeroCredit);

        // return new JsonResponse($tableau);

        return $this->render('demande_credit/amortissement/index.html.twig', [
            'codeclientdemande'=>$codeclientdemande,
            'TypeClientDemande'=>$TypeClientDemande,
            'MontantDemande'=>$MontantDemande,
            'InteretA'=>$InteretA,
            'Periode' => $Periode,
            'DateDemande' =>$DateDemande,
            'Capital' => $Capital,
            'Interet' => $Interet,
            'Echeance' => $Echeance,
            'CapitalRD'=>$CapitalRD,
            'IRD '=>$IRD,
            'CRD'=>$CRD,
            'codecredit' => $codecredit,
            'tableau'=>$tableau
        ]);

    }

    #[Route('/new', name: 'app_demande_credit_new', methods: ['GET', 'POST'])]
    public function new(TableauAmmortissementDemandeService $ammortissement,EntityManagerInterface $em,Request $request,PatrimoineCreditRepository $patrimoineCreditRepository, DemandeCreditRepository $demandeCreditRepository,Types $traitement,ManagerRegistry $doctine ): Response
    {

        /**
         * Individuel client
         */

        $TypeClient=$request->query->get('TypeClient');
        $CodeClient=$request->query->get('CodeClient');
        $nom=$request->query->get('nom');
        $prenom=$request->query->get('prenom');
        $codeclient=$request->query->get('codeclient');
        $codecreditindividuelprecedent=$request->query->get('codecreditindividuelprecedent');
        $nombrecreditindividuel=$request->query->get('nombrecreditindividuel');


        // dd($TypeClient,$CodeClient,$nom,$prenom,$codeclient);

        $Codegroupe =$request->query->get('CodeGroupe');
        $nomgroupe=$request->query->get('nomgroupe');
        $codegroupe=$request->query->get('codegroupe');

        // Patrimoine credit

        
        // Patrimoine credit
        
        $patrimoinecredit=new PatrimoineCredit();

        // Demande credit
        $demandeCredit = new DemandeCredit();
        
        $form = $this->createForm(DemandeCreditType::class, $demandeCredit);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

                         
            //  Patrimoine
            
            // Code client
            $codeclient=$demandeCredit->getCodeclient();
            $patrimoinecredit->setCodeClient($codeclient);

            // Libelle 1
            $libelle1=$form->get('Libelle1')->getData();
            $patrimoinecredit->setLibelle1($libelle1);

            // Montant1
            $montant1=$form->get('Montant0')->getData();
            $patrimoinecredit->setMontant($montant1);

            // Libelle 2
            $libelle2=$form->get('Libelle2')->getData();
            $patrimoinecredit->setLibelle2($libelle2);

            // Montant2
            $montant2=$form->get('Montant2')->getData();
            $patrimoinecredit->setMontant2($montant2);

            // Libelle 3
            $libelle3=$form->get('Libelle3')->getData();
            $patrimoinecredit->setLibelle3($libelle3);

            // Montant3
            $montant3=$form->get('Montant3')->getData();
            $patrimoinecredit->setMontant3($montant3);

            // Libelle 4
            $libelle4=$form->get('Libelle4')->getData();
            $patrimoinecredit->setLibelle4($libelle4);

            // Montant4
            $montant4=$form->get('Montant4')->getData();
            $patrimoinecredit->setMontant4($montant4);

            $em->persist($patrimoinecredit);

            // Demande credit
            // Recuperation des donnees venant du formulaire

           $data = $form->getData();

           $demandeCredit->setStatusApp("en attente ");

           $codecredit = $demandeCredit->getNumeroCredit();

           $codeclientdemande=$demandeCredit->getCodeclient();

           $TypeClientDemande=$demandeCredit->getTypeClient();

           $DateDemande=$demandeCredit->getDateDemande();

           $MontantDemande=$demandeCredit->getMontant();

           $InteretAnnuel=$demandeCredit->getTauxInteretAnnuel();

           $Periode=$demandeCredit->getNombreTranche();

           $TypeTranche=$demandeCredit->getTypeTranche();

           $demandeCreditRepository->add($demandeCredit, true);

            /***Amortissement simple */
           if($data->getTypeTranche() == "Lineaire")
           {
                return $this->redirectToRoute('app_ammortissement', [
                    'codecredit' => $codecredit,
                    'codeclient'=>$codeclientdemande,
                    'TypeClient'=>$TypeClientDemande,
                    'DateDemande'=>$DateDemande,
                    'MontantDemande'=>$MontantDemande,
                    'InteretAnnuel'=>$InteretAnnuel,
                    'Periode'=>$Periode,
                    'TypeTranche'=>$TypeTranche
            
                ], Response::HTTP_SEE_OTHER);
           }
        // if($data->getTypeTranche() == 'Lineaire'){
        //     return $this->redirectToRoute('app_lineaire',[
        //         'codecredit' => $codecredit,
        //     ],Response::HTTP_SEE_OTHER);
        // }

             /***Amortissement Degressif */
            //  if($data->getTypeTranche() == "Degressif")
            //  {
            //       $traitement->Degressif($data);
            //       return $this->redirectToRoute('app_degressif_ammortissement', [
            //           'codecredit' => $codecredit,
            //       ], Response::HTTP_SEE_OTHER);
            //  } 
           
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
            'nom'=>$nom,
            'prenom'=>$prenom,
            'TypeClient'=>$TypeClient,
            'codeclient'=>$codeclient,
            'nombrecreditindividuel'=>$nombrecreditindividuel,
            'codecreditindividuelprecedent'=>$codecreditindividuelprecedent,
            'nomgroupe'=>$nomgroupe,
            'codegroupe'=>$codegroupe,
            'form' => $form,
            // 'patrimoine'=>$patrimoine
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
