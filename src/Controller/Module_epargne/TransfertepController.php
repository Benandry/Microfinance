<?php

namespace App\Controller\Module_epargne;

use App\Entity\Transaction;
use App\Entity\Transfertep;
use App\Form\TransfertepType;
use App\Repository\TransfertepRepository;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/transfertep')]
class TransfertepController extends AbstractController
{
    #[Route('/', name: 'app_transfertep_index', methods: ['GET'])]
    public function index(TransfertepRepository $transfertepRepository): Response
    {
        return $this->render('Module_epargne/transfertep/index.html.twig', [
            'transferteps' => $transfertepRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_transfertep_new', methods: ['GET', 'POST'])]
    public function new(PersistenceManagerRegistry $doctrine,Request $request, TransfertepRepository $transfertepRepository): Response
    {
       
        $transfertep = new Transfertep();
       
        $form = $this->createForm(TransfertepType::class, $transfertep);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $transfertep->setCodetransactionT(random_int(1,1000000000));
            $entityManager=$doctrine->getManager();

            /**Compte expediteur Expediteur */
            $transactionExp = new Transaction();
            $transactionExp->setDescription($transfertep->getDescriptionT()." Compte expediteur ");
            $transactionExp->setPieceComptable($transfertep->getPieceComptableT());
            $transactionExp->setDateTransaction($transfertep->getDateTransactionT());
            $transactionExp->setMontant(-$transfertep->getMontantdestinataire());
            $transactionExp->setCommission($transfertep->getCommission());
            $transactionExp->setTypeClient($transfertep->getTypeClientT());
            $transactionExp->setCodetransaction($transfertep->getCodetransactionT());
            $transactionExp->setCodeepargneclient($form->get('expediteur')->getData());
            $transactionExp->setSolde($form->get('soldeenvoyeur')->getData());
            $entityManager->persist($transactionExp);
            
             /**Compte expediteur Destinateur */
             
            $transfertep->setMontantdestinataire($transfertep->getMontantdestinataire());
             $transactionDest = new Transaction();
             $transactionDest->setDescription($transfertep->getDescriptionT()." Compte destinateur ");
             $transactionDest->setPieceComptable($transfertep->getPieceComptableT());
             $transactionDest->setDateTransaction($transfertep->getDateTransactionT());
             $transactionDest->setMontant($transfertep->getMontantdestinataire());
             $transactionDest->setCommission($transfertep->getCommission());
             $transactionDest->setTypeClient($transfertep->getTypeClientT());
             $transactionDest->setCodetransaction($transfertep->getCodetransactionT());
             $transactionDest->setCodeepargneclient($form->get('receveur')->getData());
             $transactionDest->setSolde($form->get('soldedestinataire')->getData());
             $entityManager->persist($transactionDest);

            $entityManager->flush();
            $this->addFlash('info', " Le transfert du ".$form->get('expediteur')->getData()." ".$form->get('nomenvoyeur')->getData()."  ".$form->get('prenomenvoyeur')->getData(). "  vers ".$form->get('receveur')->getData()." ".$form->get('nomdestinatare')->getData()."  ".$form->get('prenomdestinataire')->getData()."  de ".abs($transfertep->getMontantdestinataire())." Ar du  réussite!!!");
            return $this->redirectToRoute('app_transfertep_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_epargne/transfertep/new.html.twig', [
            'transfertep' => $transfertep,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_transfertep_show', methods: ['GET'])]
    public function show(Transfertep $transfertep): Response
    {
        return $this->render('Module_epargne/transfertep/show.html.twig', [
            'transfertep' => $transfertep,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_transfertep_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Transfertep $transfertep, TransfertepRepository $transfertepRepository): Response
    {
        $form = $this->createForm(TransfertepType::class, $transfertep);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transfertepRepository->add($transfertep, true);

            return $this->redirectToRoute('app_transfertep_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Module_epargne/transfertep/edit.html.twig', [
            'transfertep' => $transfertep,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_transfertep_delete', methods: ['POST'])]
    public function delete(Request $request, Transfertep $transfertep, TransfertepRepository $transfertepRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transfertep->getId(), $request->request->get('_token'))) {
            $transfertepRepository->remove($transfertep, true);
        }

        return $this->redirectToRoute('app_transfertep_index', [], Response::HTTP_SEE_OTHER);
    }
}