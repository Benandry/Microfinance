<?php

namespace App\Controller\Credit\Decaissement;

use App\Controller\Comptabilite\TraitementCompta\ComptaDecaissement;
use App\Entity\Decaissement;
use App\Entity\FicheDeCredit;
use App\Entity\Transaction;
use App\Form\DecaissementType;
use App\Repository\DecaissementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('decaissement/credit/crud')]
class CrudDecaissementController extends AbstractController
{
    #[Route('/', name: 'app_crud_decaissement_index', methods: ['GET'])]
    public function index(DecaissementRepository $decaissementRepository): Response
    {
        return $this->render('crud_decaissement/index.html.twig', [
            'decaissements' => $decaissementRepository->findAll(),
        ]);
    }

    #[Route('/new/individuel', name: 'app_crud_decaissement_new_individuel', methods: ['GET', 'POST'])]
    public function individuel(EntityManagerInterface $em,ManagerRegistry $doctrine, Request $request, DecaissementRepository $decaissementRepository,ComptaDecaissement $compta): Response
    {
        $Mode=$request->query->get('Mode');
        $Client=$request->query->get('Client');
        $nomclient=$request->query->get('nomclient');
        $prenomclient=$request->query->get('prenomclient');
        $numerocredit=$request->query->get('numerocredit');
        $montantcredit=$request->query->get('montantcredit');
        $Interet=$request->query->get('Interet');
        // dd($Interet);
        // dd($Client,$nomclient,$prenomclient,$numerocredit,$montantcredit);

        // Calcule Interet
        $InteretDecaisser=$montantcredit*$Interet/100;

        // Calcul Total Credit
        $TotalCreditDecaisser=$montantcredit+$InteretDecaisser;

        $demandeApprouver = $request->query->all();
        $decaissement = new Decaissement();
        $transaction= new Transaction();
        // Fiche de credit
        $fichedecredit=new FicheDeCredit();
        // dd($demandeApprouver);

        // $codecredit = $demandeApprouver['liste']['codeclient'];

        // $cycle = $decaissementRepository->findByCycle($codecredit)[0][1];

        $form = $this->createForm(DecaissementType::class, $decaissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Envoi du solde dans le compte epargne
            $transaction->setDescription('TRANSFERT');

            $piececomptable=$decaissement->getPieceComptable();
            $transaction->setPieceComptable($piececomptable);

            $datedecaissement=$decaissement->getDateDecaissement();
            $transaction->setDateTransaction($datedecaissement);

            $transaction->setMontant($TotalCreditDecaisser);
            

            $transaction->setTypeClient("INDIVIDUEL");
            
            $transaction->setSolde($TotalCreditDecaisser);

            $codetransaction=random_int(2,1000000000);
            $transaction->setCodetransaction($codetransaction);

            $codeepargne=$decaissement->getNumeroCompteEpargne();
            $transaction->setCodeepargneclient($codeepargne);

            
            $em->persist($transaction);
            $em->flush();


            
            // dd($decaissement->getNumeroCredit());
            $decaissement->setRefDecaissement($codetransaction);
            $decaissement->setMontantCredit($TotalCreditDecaisser);
            $decaissement->setCapital($montantcredit);
            $decaissement->setInteret($InteretDecaisser);

            $em=$doctrine->getManager();
            
            // $debit = $form->get('debit')->getData();
            // $credit = $form->get('credit')->getData();
            // dd($debit);
            // $compta->decaissement($em,$decaissement);
            
            $decaissementRepository->add($decaissement, true);
            
            // Fiche de credit
                $fichedecredit->setNumeroCredit($numerocredit);
                $fichedecredit->setDateTransaction($datedecaissement);
                $fichedecredit->setTransaction('Decaissement');
                $montant=$decaissement->getMontantCredit();
                $fichedecredit->setCapital($montantcredit);
                // interet
                $fichedecredit->setInteret($InteretDecaisser);
                // Total
                $fichedecredit->setTotal($TotalCreditDecaisser);
    
                $em->persist($fichedecredit);
                $em->flush();
    
            

            $this->addFlash('success', "Décaissement de credit  ".$decaissement->getNumeroCredit()." reuissite .Réferences : ".$decaissement->getRefDecaissement());
            return $this->redirectToRoute('app_decaissement_credit_individuel', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_credit/crud_decaissement/individuel.html.twig', [
            'decaissement' => $decaissement,
            'nomclient'=>$nomclient,
           'prenomclient'=>$prenomclient,
            'numerocredit'=>$numerocredit,
            'montantcredit'=>$TotalCreditDecaisser,    
            'form' => $form,
            'demandes' => $demandeApprouver,
            'Mode'=>$Mode,
            'TotalCreditDecaisser'=>$TotalCreditDecaisser
                ]);
    }

    #[Route('/new/groupe', name: 'app_crud_decaissement_new_groupe', methods: ['GET', 'POST'])]
    public function groupe(EntityManagerInterface $em,ManagerRegistry $doctrine, ComptaDecaissement $compta, Request $request, DecaissementRepository $decaissementRepository): Response
    {
        $demandeApprouver = $request->query->all();
        $decaissement = new Decaissement();
        $transaction=new Transaction();
        $codecredit = $demandeApprouver['liste']['codeclient'];
        
        $cycle = $decaissementRepository->findByCycle($codecredit)[0][1];

        $form = $this->createForm(DecaissementType::class, $decaissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                        //Envoi du solde dans le compte epargne
                        $transaction->setDescription('TRANSFERT');

                        $piececomptable=$decaissement->getPieceComptable();
                        $transaction->setPieceComptable($piececomptable);
            
                        $datedecaissement=$decaissement->getDateDecaissement();
                        $transaction->setDateTransaction($datedecaissement);
            
                        $montant=$decaissement->getMontantCredit();
                        $transaction->setMontant($montant);
            
            
                        $transaction->setTypeClient("GROUPE");
            
                        $transaction->setSolde($montant);
            
                        $codetransaction=random_int(2,1000000000);
                        $transaction->setCodetransaction($codetransaction);
            
                        $codeepargne=$decaissement->getNumeroCompteEpargne();
                        $transaction->setCodeepargneclient($codeepargne);
            
            
                        $em->persist($transaction);
                        $em->flush();
            


            // dd($decaissement);
            $decaissement->setRefDecaissement($codetransaction);

            $em=$doctrine->getManager();
            
            $debit = $form->get('debit')->getData();
            $credit = $form->get('credit')->getData();
            $compta->decaissement($em,$decaissement,$debit,$credit);

            $decaissementRepository->add($decaissement, true);
            $this->addFlash('success', " Decaissement de credit ".$decaissement->getNumeroCredit()." reuissite ");
            return $this->redirectToRoute('app_decaissement_credit_groupe', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_credit/crud_decaissement/groupe.html.twig', [
            'decaissement' => $decaissement,
            'form' => $form,
            'demandes' => $demandeApprouver,
            'cycle' => $cycle
        ]);
    }

    #[Route('/{id}', name: 'app_crud_decaissement_show', methods: ['GET'])]
    public function show(Decaissement $decaissement): Response
    {
        return $this->render('crud_decaissement/show.html.twig', [
            'decaissement' => $decaissement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_crud_decaissement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Decaissement $decaissement, DecaissementRepository $decaissementRepository): Response
    {
        $form = $this->createForm(DecaissementType::class, $decaissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $decaissementRepository->add($decaissement, true);

            return $this->redirectToRoute('app_crud_decaissement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud_decaissement/edit.html.twig', [
            'decaissement' => $decaissement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_crud_decaissement_delete', methods: ['POST'])]
    public function delete(Request $request, Decaissement $decaissement, DecaissementRepository $decaissementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$decaissement->getId(), $request->request->get('_token'))) {
            $decaissementRepository->remove($decaissement, true);
        }

        return $this->redirectToRoute('app_crud_decaissement_index', [], Response::HTTP_SEE_OTHER);
    }
}
