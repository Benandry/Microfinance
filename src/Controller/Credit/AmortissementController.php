<?php

namespace App\Controller\Credit;

use App\Entity\AmortissementFixe;
use App\Repository\AmortissementFixeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Persistence\ManagerRegistry;

class AmortissementController extends AbstractController
{
    ///Amortissement Lineaire
    #[Route('/demande/tableau/amortissement', name: 'app_tableau_amortissement')]
    public function lineaire(Request $request ,AmortissementFixeRepository $repoAmortisssement): Response
    {

        /********Les tableau d'amortissement */
        $codecredit = $request->query->get('codecredit');
        $info = $repoAmortisssement->findInfoCredit($codecredit);

    //    dd($info);
        $tableau_amortissement = $repoAmortisssement->findAmortissement($codecredit);
        $sumMontant = array_sum(array_column($tableau_amortissement,'principale'));
        $sumInteret = array_sum(array_column($tableau_amortissement,'interet'));
        $sumNet = array_sum(array_column($tableau_amortissement,'montanttTotal'));
        $soldedu=array_sum(array_column($tableau_amortissement,'soldedu'));

        // dd($soldedu);

        $form = $this->createFormBuilder()
            ->add('submit', SubmitType::class,[
                'label' => 'Terminer',
                'attr' => [
                    'class' => 'btn btn-primary btn-sm'
                ]
            ])
            ->getForm();


    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()){
            $this->addFlash('success', "Demande de credit ".$codecredit." terminée " );
            return $this->redirectToRoute('app_demande_credit_new', [], Response::HTTP_SEE_OTHER);

        }
        return $this->render('demande_credit/amortissement/index.html.twig', [
            'info' => $info,
            'amortissement' =>$tableau_amortissement,
            'totalMontant' => $sumMontant,
            'totalInteret' => $sumInteret,
            'totalNet' => $sumNet,
            'soldedu'=>$soldedu,
            'form' => $form->createView(),
             'codecredit' => $codecredit,
        ]);
    }

    #[Route('/demandecredit/tableauamortissement/Degressif', name: 'app_degressif_ammortissement')]
    public function Degressif(Request $request ,AmortissementFixeRepository $repoAmortisssement): Response
    {

        /********Les tableau d'amortissement */
        $codecredit = $request->query->get('codecredit');
        $info = $repoAmortisssement->findInfoCredit($codecredit);

    //    dd($info);
        $tableau_amortissement = $repoAmortisssement->findAmortissement($codecredit);
        $sumMontant = array_sum(array_column($tableau_amortissement,'principale'));
        $sumInteret = array_sum(array_column($tableau_amortissement,'interet'));
        $sumNet = array_sum(array_column($tableau_amortissement,'montanttTotal'));
        $soldedu=array_sum(array_column($tableau_amortissement,'soldedu'));

        // dd($soldedu);

        $form = $this->createFormBuilder()
            ->add('submit', SubmitType::class,[
                'label' => 'Terminer',
                'attr' => [
                    'class' => 'btn btn-primary btn-sm'
                ]
            ])
            ->getForm();


    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()){
            $this->addFlash('success', "Demande de credit ".$codecredit." terminée " );
            return $this->redirectToRoute('app_demande_credit_new', [], Response::HTTP_SEE_OTHER);

        }
        return $this->render('demande_credit/amortissement/Degressif.html.twig', [
            'info' => $info,
            'amortissement' =>$tableau_amortissement,
            'totalMontant' => $sumMontant,
            'totalInteret' => $sumInteret,
            'totalNet' => $sumNet,
            'soldedu'=>$soldedu,
            'form' => $form->createView(),
             'codecredit' => $codecredit,
        ]);
    }
}
