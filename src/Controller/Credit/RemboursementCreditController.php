<?php

namespace App\Controller\Credit;

use App\Entity\RemboursementCredit;
use App\Form\RemboursementCreditType;
use App\Repository\RemboursementCreditRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/remboursement/credit')]
class RemboursementCreditController extends AbstractController
{
    #[Route('/', name: 'app_remboursement_credit_index', methods: ['GET'])]
    public function index(RemboursementCreditRepository $remboursementCreditRepository): Response
    {
        return $this->render('remboursement_credit/index.html.twig', [
            'remboursement_credits' => $remboursementCreditRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_remboursement_credit_new', methods: ['GET', 'POST'])]
    public function new(EntityManagerInterface $em, ManagerRegistry $doctrine, Request $request, RemboursementCreditRepository $remboursementCreditRepository): Response
    {
        // Recuperation du code credit
        // dd($request);
        $typeclient=$request->query->get('typeclient');
        $codecredit = $request->query->get('codecredit');
        $penalitenonrmebourser = $request->query->get('penalite');
        $montantprecedent = $request->query->get('montant');
        $montantdu = $request->query->get('montantdu');
        $periode = $request->query->get('periode');
        $totalperiode=$request->query->get('TotalPeriode');
        $restemontant = $request->query->get('restemontant');
        $resteprecedent=$restemontant+$penalitenonrmebourser;
        $crd=$request->query->get('crd');
        $TotalRembourser=$request->query->get('TotalRembourser');
        $TotalaRembourser=$request->query->get('TotalaRembourser');
        
        // dd($typeclient);

        $historique = $remboursementCreditRepository->HistoriqueRemboursement($codecredit);
        $tableauAmmortissemnt = $remboursementCreditRepository->TableauAmmortissement($codecredit);

        
        $remboursementCredit = new RemboursementCredit();

        $form = $this->createForm(RemboursementCreditType::class, $remboursementCredit);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $doctrine->getManager();
            
            // Anticipe
            
            // $anticipe = $remboursementCredit->getAnticipe();
            
            $echeance=$remboursementCredit->getMontantEcheance();

            // dd($echeance);
            // Montant taper par l'utilisateur

            $montantrembourser = $remboursementCredit->getMontantTotalPaye();

            if ($montantrembourser > $echeance && $restemontant == 0) {
                $periodeactuel=$remboursementCredit->getPeriode();
                $commentaire='ANTICIPE';

                // Calcul des periodes restant
                $resteperiode=$totalperiode-$periode;
                // dd($resteperiode); 


                // Regle de 3
                $tranche=$montantrembourser*$resteperiode/$TotalaRembourser;
                // dd($tranche);

                // Montant anticip??
                $montantrembourseranticipe=$montantrembourser/$tranche;

                $montant=[
                    [
                        'NumeroCredit' => $remboursementCredit->getNumeroCredit(),
                        'DateRemboursement'=>$remboursementCredit->getDateRemboursement(),
                        'PieceCompteble' => $remboursementCredit->getPieceCompteble(),
                        'MontantTotalPaye' => $montantrembourseranticipe,
                        'Papeterie' => $remboursementCredit->getPapeterie(),
                        'TransactionEnLiquide' => $remboursementCredit->isTransactionEnLiquide(),
                        'TransfertEpargne' => $remboursementCredit->isTransfertEpargne(),
                        'Caisse' => $remboursementCredit->getCaisse(),
                        'Periode' => $periodeactuel++,
                        'Penalite' => $remboursementCredit->getPenalite(),
                        'Commentaire' => $commentaire,
                        'TypeClient'=>$typeclient

                    ]
                ];

                for($i=1 ; $i < $tranche ;$i++){

                    // On incremente la periode 
                    
                    array_push($montant,[
                        'NumeroCredit' => $remboursementCredit->getNumeroCredit(),
                        'DateRemboursement'=>$remboursementCredit->getDateRemboursement(),
                        'PieceCompteble' => $remboursementCredit->getPieceCompteble(),
                        'MontantTotalPaye' => $montantrembourseranticipe,
                        'Papeterie' => $remboursementCredit->getPapeterie(),
                        'TransactionEnLiquide' => $remboursementCredit->isTransactionEnLiquide(),
                        'TransfertEpargne' => $remboursementCredit->isTransfertEpargne(),
                        'Caisse' => $remboursementCredit->getCaisse(),
                        'Periode' => $periodeactuel++,
                        'Penalite' => $remboursementCredit->getPenalite(),
                        'Commentaire' => $commentaire,
                        'TypeClient'=>$typeclient
                    ]);

                }

                // dd($montant);

                // On inserer dans la base de donnees
                foreach($montant as $montant){
                    
                    $ant=new RemboursementCredit();

                    $ant->setNumeroCredit($montant['NumeroCredit']);
                    $ant->setDateRemboursement($remboursementCredit->getDateRemboursement());
                    $ant->setPieceCompteble($montant['PieceCompteble']);
                    $ant->setMontantTotalPaye($montant['MontantTotalPaye']);
                    $ant->setPapeterie($montant['Papeterie']);
                    $ant->setTransactionEnLiquide($montant['TransactionEnLiquide']);
                    $ant->setTransfertEpargne($montant['TransfertEpargne']);
                    $ant->setCaisse($montant['Caisse']);
                    $ant->setPeriode($montant['Periode']);
                    $ant->setPenalite($montant['Penalite']);
                    $ant->setCommentaire($montant['Commentaire']);
                    $ant->setTypeClient($montant['TypeClient']);

                    $em->persist($ant);
                    $em->flush();

                }

                // dd($montant);

            }

            // Si le p??nalite est different de null


            else if ($montantprecedent < $montantdu) {

                // On recupere le montant echeance

                $MontantEcheance=$remboursementCredit->getMontantEcheance();

                // On recuperer le montant taper par l'utilisateur
                $montantrembourser = $remboursementCredit->getMontantTotalPaye();

                // On recupere le montant precedent et on fait la difference pour avoir 
                // le reste a payer
                $resteapayeravecpenalite = $resteprecedent;
                // dd($resteapayeravecpenalite);

                // dd($montantrembourser.'-'.$restemontant.'='.$montantacomplementer);

                // Reste sans penalite
                $restemontant;

                // penalite
                $penalitenonrmebourser;

                // avec les penalites
                // $resteapayeravecpenalite = $resteapayer + $penalitenonrmebourser;

                // Reste de prochain
                $reste = $montantrembourser - $resteapayeravecpenalite;

                // Complement du manque precedent
                $complement = $resteapayeravecpenalite-$penalitenonrmebourser;

                // penelite
                $penalitearemb=$penalitenonrmebourser;
                // Autre
                $penal=0;
                // Stocke dans la table

                // dd($reste,$complement,$penalitearemb);

                // dd($reste,$complement);
                // Si le reste egal au montant du
                if ($reste  == $MontantEcheance) {

                    $remboursementretard = [
                        // ligne 1
                        array(
                            'NumeroCredit' => $remboursementCredit->getNumeroCredit(),
                            'DateRemboursement'=>$remboursementCredit->getDateRemboursement(),
                            'PieceCompteble' => $remboursementCredit->getPieceCompteble(),
                            'MontantTotalPaye' => $complement,
                            'Papeterie' => $remboursementCredit->getPapeterie(),
                            'TransactionEnLiquide' => $remboursementCredit->isTransactionEnLiquide(),
                            'TransfertEpargne' => $remboursementCredit->isTransfertEpargne(),
                            'Caisse' => $remboursementCredit->getCaisse(),
                            'Periode' => $remboursementCredit->getPeriode()-1,
                            'Penalite' => $remboursementCredit->getPenalite(),
                            'Commentaire' => $remboursementCredit->getCommentaire(),
                            'TypeClient'=>$typeclient,
                            'PenalitePaye'=>$penalitearemb,
                        ),
                        // ligne 2
                        array(
                            'NumeroCredit' => $remboursementCredit->getNumeroCredit(),
                            'DateRemboursement'=>$remboursementCredit->getDateRemboursement(),
                            'PieceCompteble' => $remboursementCredit->getPieceCompteble(),
                            'MontantTotalPaye' => $reste,
                            'Papeterie' => $remboursementCredit->getPapeterie(),
                            'TransactionEnLiquide' => $remboursementCredit->isTransactionEnLiquide(),
                            'TransfertEpargne' => $remboursementCredit->isTransfertEpargne(),
                            'Caisse' => $remboursementCredit->getCaisse(),
                            'Periode' => $remboursementCredit->getPeriode(),
                            'Penalite' => $remboursementCredit->getPenalite(),
                            'Commentaire' => $remboursementCredit->getCommentaire(),
                            'TypeClient'=>$typeclient,
                            'PenalitePaye'=>$penal,
                        ),

                    ];

                    // dd($remboursementretard);

                    foreach ($remboursementretard as $remboursementData) {

                        $remb = new RemboursementCredit;

                        $remb->setNumeroCredit($remboursementData['NumeroCredit']);
                        $remb->setDateRemboursement($remboursementCredit->getDateRemboursement());
                        $remb->setPieceCompteble($remboursementData['PieceCompteble']);
                        $remb->setMontantTotalPaye($remboursementData['MontantTotalPaye']);
                        $remb->setPapeterie($remboursementData['Papeterie']);
                        $remb->setTransactionEnLiquide($remboursementData['TransactionEnLiquide']);
                        $remb->setTransfertEpargne($remboursementData['TransfertEpargne']);
                        $remb->setCaisse($remboursementData['Caisse']);
                        $remb->setPeriode($remboursementData['Periode']);
                        $remb->setPenalite($remboursementData['Penalite']);
                        $remb->setCommentaire($remboursementData['Commentaire']);
                        $remb->setTypeClient($remboursementData['TypeClient']);
                        $remb->setPenalitePaye($remboursementData['PenalitePaye']);

                        $em->persist($remb);

                        $em->flush();
                    }
                }

                // Si le montant a payer est encore incomplet par rapport au montant du

                else if ($reste < $MontantEcheance) {

                    $penalite = ($montantdu * 2 / 100);
                    $Commentaire = 'RETARD';

                    // dd($penalite);

                    $remboursementretarddouble = [
                        // ligne 1
                        array(
                            'NumeroCredit' => $remboursementCredit->getNumeroCredit(),
                            // 'DateRemboursement'=>$remboursementCredit->getDateRemboursement(),
                            'PieceCompteble' => $remboursementCredit->getPieceCompteble(),
                            'MontantTotalPaye' => $complement,
                            'Papeterie' => $remboursementCredit->getPapeterie(),
                            'TransactionEnLiquide' => $remboursementCredit->isTransactionEnLiquide(),
                            'TransfertEpargne' => $remboursementCredit->isTransfertEpargne(),
                            'Caisse' => $remboursementCredit->getCaisse(),
                            'Periode' => $remboursementCredit->getPeriode()-1,
                            'Penalite' => $remboursementCredit->getPenalite(),
                            'Commentaire' => $remboursementCredit->getCommentaire(),
                            'TypeClient'=>$typeclient

                        ),
                        // ligne 2
                        array(
                            'NumeroCredit' => $remboursementCredit->getNumeroCredit(),
                            // 'DateRemboursement'=>$remboursementCredit->getDateRemboursement(),
                            'PieceCompteble' => $remboursementCredit->getPieceCompteble(),
                            'MontantTotalPaye' => $reste,
                            'Papeterie' => $remboursementCredit->getPapeterie(),
                            'TransactionEnLiquide' => $remboursementCredit->isTransactionEnLiquide(),
                            'TransfertEpargne' => $remboursementCredit->isTransfertEpargne(),
                            'Caisse' => $remboursementCredit->getCaisse(),
                            'Periode' => $remboursementCredit->getPeriode(),
                            'Penalite' => $penalite,
                            'Commentaire' => $Commentaire,
                            'TypeClient'=>$typeclient
                        ),

                    ];

                    // dd($remboursementretard);

                    foreach ($remboursementretarddouble as $remboursementData) {

                        $rembRetardDouble = new RemboursementCredit;

                        $rembRetardDouble->setNumeroCredit($remboursementData['NumeroCredit']);
                        $rembRetardDouble->setDateRemboursement($remboursementCredit->getDateRemboursement());
                        $rembRetardDouble->setPieceCompteble($remboursementData['PieceCompteble']);
                        $rembRetardDouble->setMontantTotalPaye($remboursementData['MontantTotalPaye']);
                        $rembRetardDouble->setPapeterie($remboursementData['Papeterie']);
                        $rembRetardDouble->setTransactionEnLiquide($remboursementData['TransactionEnLiquide']);
                        $rembRetardDouble->setTransfertEpargne($remboursementData['TransfertEpargne']);
                        $rembRetardDouble->setCaisse($remboursementData['Caisse']);
                        $rembRetardDouble->setPeriode($remboursementData['Periode']);
                        $rembRetardDouble->setPenalite($remboursementData['Penalite']);
                        $rembRetardDouble->setCommentaire($remboursementData['Commentaire']);
                        $rembRetardDouble->setTypeClient($remboursementData['TypeClient']);

                        $em->persist($rembRetardDouble);

                        $em->flush();
                    }
                }
            } else {

                $numerocredit = $remboursementCredit->getNumeroCredit();
                $remboursementCredit->setNumeroCredit($numerocredit);

                $dateremboursement = $remboursementCredit->getDateRemboursement();
                $remboursementCredit->setDateRemboursement($dateremboursement);

                $piececomptable = $remboursementCredit->getPieceCompteble();
                $remboursementCredit->setPieceCompteble($piececomptable);

                $montantTotalPayes = $remboursementCredit->getMontantTotalPaye();
                $remboursementCredit->setMontantTotalPaye($montantTotalPayes);

                $papeterie = $remboursementCredit->getPapeterie();
                $remboursementCredit->setPapeterie($papeterie);

                $istransactionliquide = $remboursementCredit->isTransactionEnLiquide();
                $remboursementCredit->setTransactionEnLiquide($istransactionliquide);

                $istransfertepargne = $remboursementCredit->isTransfertEpargne();
                $remboursementCredit->setTransfertEpargne($istransfertepargne);

                $caisseepargne = $remboursementCredit->getCaisse();
                $remboursementCredit->setCaisse($caisseepargne);

                $periode = $remboursementCredit->getPeriode();
                $remboursementCredit->setPeriode($periode);

                $penalite = $remboursementCredit->getPenalite();
                $remboursementCredit->setPenalite($penalite);

                $Commentaire = $remboursementCredit->getCommentaire();
                $remboursementCredit->setCommentaire($Commentaire);

                $TypeClient=$remboursementCredit->getTypeClient();
                $remboursementCredit->setTypeClient($TypeClient);

                $entityManager->persist($remboursementCredit);
            }
            $entityManager->flush();


            $this->addFlash('success', 'Remboursement de credit reussi !');
            return $this->redirectToRoute('app_remboursement_credit_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('remboursement_credit/new.html.twig', [
            'codecredit' => $codecredit,
            'penalite' => $penalitenonrmebourser,
            'montant' => $montantprecedent,
            'motantdu'=>$montantdu,
            'historique' => $historique,
            'montantdu' => $montantdu,
            'periode'=>$periode,
            'restemontant'=>$restemontant,
            'tableauAmmortissemnt' => $tableauAmmortissemnt,
            'remboursement_credit' => $remboursementCredit,
            'TotalRembourser' => $TotalRembourser,
            'TotalaRembourser' => $TotalaRembourser,
            'crd'=>$crd,
            'totalperiode'=>$totalperiode,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_remboursement_credit_show', methods: ['GET'])]
    public function show(RemboursementCredit $remboursementCredit): Response
    {
        return $this->render('remboursement_credit/show.html.twig', [
            'remboursement_credit' => $remboursementCredit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_remboursement_credit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RemboursementCredit $remboursementCredit, RemboursementCreditRepository $remboursementCreditRepository): Response
    {
        $form = $this->createForm(RemboursementCreditType::class, $remboursementCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $remboursementCreditRepository->save($remboursementCredit, true);

            return $this->redirectToRoute('app_remboursement_credit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('remboursement_credit/edit.html.twig', [
            'remboursement_credit' => $remboursementCredit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_remboursement_credit_delete', methods: ['POST'])]
    public function delete(Request $request, RemboursementCredit $remboursementCredit, RemboursementCreditRepository $remboursementCreditRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $remboursementCredit->getId(), $request->request->get('_token'))) {
            $remboursementCreditRepository->remove($remboursementCredit, true);
        }

        return $this->redirectToRoute('app_remboursement_credit_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @method mixed HistoriqueRemboursement()
     *
     * @return void
     */
    
    // #[Route('/historique/remboursement/{codecredit}',name:'app_historique_remboursement')]
    // public function HistoriqueRemboursement(RemboursementCreditRepository $remboursementCreditRepository,string $codecredit)
    // {
    //     $historique=$remboursementCreditRepository->HistoriqueRemboursement($codecredit);

    //     return $this->renderForm('remboursement_credit/new.html.twig', [
    //         'historique'=>$historique,
    //     ]);

    // }
}
