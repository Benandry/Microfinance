<?php

namespace App\Form;

use App\Entity\CategorieCredit;
use App\Entity\DemandeCredit;
use App\Entity\FondCredit;
use App\Entity\ProduitCredit;
use App\Entity\ProduitEpargne;
use App\Entity\User;
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
            ->add('FondCredit',EntityType::class,[
                'class'=>FondCredit::class,
                'choice_label'=>'NomBailleurs',
                'mapped'=>true,
                'required'=>false,
                'by_reference'=>true,
                'placeholder'=>'Choix fond credit'
            ])
            // ->add('MontantEpargneTranche')
            // ->add('MontantFixe')
            ->add('SoldeEpargne',TextType::class,[
                'label' => " Solde Epargne :",
                'required'=>false,
            ])
            ->add('agent',EntityType::class,[
                    'class' => User::class,
                    'choice_label' => "prenom",
                    'label' => "Agent de credit :",
                    'placeholder' => "agent de credit",
                    'autocomplete' => true,
            ])
            ->add('Categorie1Credit',EntityType::class,[
                'class'=>CategorieCredit::class,
                'choice_label'=>'NomCategorieCredit',
                'mapped'=>true,
                'label'=>" Categorie de categorie :",
                'placeholder'=>'Choix Categorie',
                'required' => false,
            ])
            // ->add('Categorie2Credit',EntityType::class,[
            //     'class'=>CategorieCredit::class,
            //     'choice_label'=>'NomCategorieCredit',
            //     'mapped'=>true,
            //     'by_reference'=>true,
            //     'placeholder'=>'Choix Categorie',
            //     'required' => false
            // ])
            // ->add('Categorie3Credit',EntityType::class,[
            //     'class'=>CategorieCredit::class,
            //     'choice_label'=>'NomCategorieCredit',
            //     'mapped'=>true,
            //     'by_reference'=>true,
            //     'placeholder'=>'Choix Categorie',
            //     'required' => false
            // ])
            // ->add('Categorie4Credit',EntityType::class,[
            //     'class'=>CategorieCredit::class,
            //     'choice_label'=>'NomCategorieCredit',
            //     'mapped'=>true,
            //     'by_reference'=>true,
            //     'placeholder'=>'Choix Categorie',
            //     'required' => false
            // ])
            ->add('CalculInteretDiffere')
            // ->add('InteretDifferePaiementCapitalise')
            // ->add('InteretPayeMemePourDiffere')
            // ->add('TrancheDistinctInteretPeriodeDiffere')
            // ->add('PaiementPrealableInteret')
            // ->add('InteretDeduitDecaissement')
            ->add('CalculInteretJours')
            // ->add('ForfaitPaiementPrealableInteret')
            // ->add('CreditLieUSD')
            // ->add('MettreJourCalendrierNonOuvrable')
            // ->add('ReporterPremierTranche')
            // ->add('CommissionPourcentageMontantCredit')
            // ->add('PourcentageCapitalEnCoursInteretCommission')
            // ->add('MontantFixeParTranche')
            // ->add('ProduitEpargne',EntityType::class,[
            //     'class'=>ProduitEpargne::class,
            //     'choice_label'=>'nomproduit'
            // ])
            ->add('ProduitCredit',EntityType::class,[
                'class'=>ProduitCredit::class,
                'choice_label'=>'NomProduitCredit',
                'mapped'=>true,
                'by_reference'=>true,
                'placeholder'=>'Choisir Produit Credit'
            ])
            
            ->add('typeAmortissement',ChoiceType::class,[
                'choices'=>[
                    'Simple'=>'simple',
                    'anuuite constante'=>'anuuite constante',
                    'amortissement constante'=>'amortissement constante',
                ],
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('garant')
            ->add('garantie')
            ->add('Valeur')
            ->add('Type')
            ->add('ValeurUnitaure')
            ->add('Unite')
            ->add('ValeurTotal')
            ->add('cycles')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DemandeCredit::class,
        ]);
    }
}
