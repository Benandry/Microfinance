<?php

namespace App\Controller\Module_epargne;

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
            // $transfertepRepository->add($transfertep, true);

           
            $entityManager=$doctrine->getManager();

            $description=$transfertep->getDescriptionT();
            $transfertep->setDescriptionT($description);

            $piececomptable=$transfertep->getPieceComptableT();
            $transfertep->setPieceComptableT($piececomptable);

            $datetransaction=$transfertep->getDateTransactionT();
            $transfertep->setDateTransactionT($datetransaction);

            $montantdest=$transfertep->getMontantdestinataire();
            $transfertep->setMontantdestinataire(-$montantdest);

            $papeterie=$transfertep->getPapeterie();
            $transfertep->setPapeterie($papeterie);

            $commission=$transfertep->getCommission();
            $transfertep->setCommission($commission);

            $typeclient=$transfertep->getTypeClientT();
            $transfertep->setTypeClientT($typeclient);

            $soldedestinataire=$transfertep->getSoldedestinataire();
            $transfertep->setSoldedestinataire($soldedestinataire);

            $soldeenv=$transfertep->getSoldeenvoyeur();
            $transfertep->setSoldeenvoyeur($soldeenv);
            
            $code_transaction = random_int(1,1000000000);
            $transfertep->setCodetransactionT($code_transaction);

            $codedest=$transfertep->getCodedestinateur();
            $transfertep->setCodedestinateur($codedest);

            $codeenv=$transfertep->getCodeenvoyeur();
            $transfertep->setCodeenvoyeur($codeenv);
            
            $entityManager->persist($transfertep);
            
            $entityManager->flush();
            //dd($form->getData());
            $this->addFlash('success', " Transfert réussite!!!");

            // return $this->redirectToRoute('app_transfertep_index', [], Response::HTTP_SEE_OTHER);
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