<?php

namespace App\Form;

use App\Entity\DemandeCredit;
use App\Entity\ProduitCredit;
use App\Entity\ProduitEpargne;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeCreditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codeclient')
            ->add('TypeClient',ChoiceType::class,[
                'choices'=>[
                    'INDIVIDUEL'=>'INDIVIDUEL',
                    'GROUPE'=>'GROUPE',
                ],
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('NumeroCredit')
            ->add('DateDemande',DateType::class,[
                'widget'=>'single_text'
            ])
            ->add('Montant')
            ->add('TauxInteretAnnuel')
            ->add('NombreTranche')
            ->add('TypeTranche')
            ->add('MethodeCalculInteret')
            ->add('DiffereDePaiement')
            ->add('CapitalDerniereEcheance')
            ->add('FondCredit')
            ->add('MontantEpargneTranche')
            ->add('MontantFixe')
            ->add('SoldeEpargne')
            ->add('Agent',TextType::class,[
                    'attr'=>[
                        'class'=>'hidden'
                    ],
                    'label'=>false
            ])
            ->add('ButCredit')
            ->add('Categorie1Credit')
            ->add('Categorie2Credit')
            ->add('Categorie3Credit')
            ->add('Categorie4Credit')
            ->add('CalculInteretDiffere')
            ->add('InteretDifferePaiementCapitalise')
            ->add('InteretPayeMemePourDiffere')
            ->add('TrancheDistinctInteretPeriodeDiffere')
            ->add('PaiementPrealableInteret')
            ->add('InteretDeduitDecaissement')
            ->add('CalculInteretJours')
            ->add('ForfaitPaiementPrealableInteret')
            ->add('CreditLieUSD')
            ->add('MettreJourCalendrierNonOuvrable')
            ->add('ReporterPremierTranche')
            ->add('CommissionPourcentageMontantCredit')
            ->add('PourcentageCapitalEnCoursInteretCommission')
            ->add('MontantFixeParTranche')
            ->add('ProduitEpargne',EntityType::class,[
                'class'=>ProduitEpargne::class,
                'choice_label'=>'nomproduit'
            ])
            ->add('ProduitCredit',EntityType::class,[
                'class'=>ProduitCredit::class,
                'choice_label'=>'NomProduitCredit',
                'mapped'=>true,
                'by_reference'=>true,
                'placeholder'=>'Choisir Produit Credit'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DemandeCredit::class,
        ]);
    }
}
