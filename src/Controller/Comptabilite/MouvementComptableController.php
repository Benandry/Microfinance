<?php

namespace App\Controller\Comptabilite;

use App\Entity\MouvementComptable;
use App\Form\MouvementComptableType;
use App\Repository\MouvementComptableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mouvement/comptable')]
class MouvementComptableController extends AbstractController
{
    #[Route('/', name: 'app_mouvement_comptable_index', methods: ['GET'])]
    public function index(MouvementComptableRepository $mouvementComptableRepository): Response
    {
        return $this->render('Comptabilite/mouvement_comptable/index.html.twig', [
            'mouvement_comptables' => $mouvementComptableRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_mouvement_comptable_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MouvementComptableRepository $mouvementComptableRepository): Response
    {
        $mouvementComptable = new MouvementComptable();
        $form = $this->createForm(MouvementComptableType::class, $mouvementComptable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reference = random_int(55550,50000000);
            $mouvementComptable->setRefTransaction($reference);
            $mouvementComptable->setSolde($form->get("montant")->getData());

            $message = "";
            if ($form->get("debit")->getData() && $form->get("credit")->getData()) { 
                //Modifier le montant de mouvement
                $mouvementComptable->setPlanCompta($form->get("debit")->getData());
                $mouvementComptable->setDebit($form->get("montant")->getData());
                $mouvementComptable->setPieceComptable($mouvementComptable->getPieceComptable());
                $mouvementComptableCredit = new MouvementComptable();  
                $mouvementComptableCredit->setDateMouvement($mouvementComptable->getDateMouvement());
                $mouvementComptableCredit->setDescription($mouvementComptable->getDescription());
                $mouvementComptableCredit->setPlanCompta($form->get("credit")->getData());            
                $mouvementComptableCredit->setCredit($form->get("montant")->getData());
                $mouvementComptableCredit->setSolde($form->get("montant")->getData());
                // $mouvementComptableCredit->setBudgetaire();
                $mouvementComptableCredit->setPieceComptable($mouvementComptable->getPieceComptable());
                $mouvementComptableCredit->setRefTransaction($reference);
                
                $mouvementComptableRepository->save($mouvementComptable, true);
                $mouvementComptableRepository->save($mouvementComptableCredit, true);
            }elseif ($form->get("analytique")->getData()) {
                $mouvementComptable->setAnalytique($form->get("analytique")->getData());
                $mouvementComptableRepository->save($mouvementComptable, true);
            }elseif ($form->get("budgetaire")->getData()) {
                $mouvementComptable->setBudgetaire($form->get("budgetaire")->getData()); 
                $mouvementComptableRepository->save($mouvementComptable, true);
            }
           

            $this->addFlash('success',"Ajout de traitement ");
            return $this->redirectToRoute('app_mouvement_comptable_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Comptabilite/mouvement_comptable/new.html.twig', [
            'mouvement_comptable' => $mouvementComptable,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mouvement_comptable_show', methods: ['GET'])]
    public function show(MouvementComptable $mouvementComptable): Response
    {
        return $this->render('Comptabilite/mouvement_comptable/show.html.twig', [
            'mouvement_comptable' => $mouvementComptable,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mouvement_comptable_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MouvementComptable $mouvementComptable, MouvementComptableRepository $mouvementComptableRepository): Response
    {
        $form = $this->createForm(MouvementComptableType::class, $mouvementComptable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mouvementComptableRepository->save($mouvementComptable, true);

            return $this->redirectToRoute('app_mouvement_comptable_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Comptabilite/mouvement_comptable/edit.html.twig', [
            'mouvement_comptable' => $mouvementComptable,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mouvement_comptable_delete', methods: ['POST'])]
    public function delete(Request $request, MouvementComptable $mouvementComptable, MouvementComptableRepository $mouvementComptableRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mouvementComptable->getId(), $request->request->get('_token'))) {
            $mouvementComptableRepository->remove($mouvementComptable, true);
        }

        return $this->redirectToRoute('app_mouvement_comptable_index', [], Response::HTTP_SEE_OTHER);
    }
}
