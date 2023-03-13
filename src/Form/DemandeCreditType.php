<?php

namespace App\Form;

use App\Entity\CategorieCredit;
use App\Entity\DemandeCredit;
use App\Entity\FondCredit;
use App\Entity\ProduitCredit;
use App\Entity\ProduitEpargne;
use App\Entity\User;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeCreditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codeclient',TextType::class,[
                'attr' => [
                    'class'=>'form-control',
                    'maxLength' =>10,
                    'minLength' =>10,
                ]
            ])
            ->add('TypeClient',TextType::class)
            ->add('NumeroCredit')
            ->add('DateDemande',DateType::class,[
                'widget'=>'single_text'
            ])
            ->add('Montant')
            ->add('TauxInteretAnnuel')
            ->add('NombreTranche')
            ->add('TypeTranche')
            // ->add('MethodeCalculInteret')
            // ->add('DiffereDePaiement')
            // ->add('CapitalDerniereEcheance')
            // ->add('FondCredit',EntityType::class,[
            //     'class'=>FondCredit::class,
            //     'choice_label'=>'NomBailleurs',
            //     'mapped'=>true,
            //     'required'=>false,
            //     'by_reference'=>true,
            //     'placeholder'=>'Choix fond credit'
            // ])
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
                    'required'=>true
            ])
            // ->add('categorieCredit',EntityType::class,[
            //     'class'=>CategorieCredit::class,
            //     'choice_label'=>'NomCategorieCredit',
            //     'autocomplete'=>true,
            //     'label'=>" Categorie de categorie :",
            //     'placeholder'=>'Choix Categorie',
            // ])
            // ->add('CalculInteretDiffere')
            // ->add('CalculInteretJours')
            ->add('ProduitCredit',EntityType::class,[
                'class'=>ProduitCredit::class,
                'choice_label'=>'NomProduitCredit',
                'by_reference'=>true,
                'placeholder'=>'Choisir Produit Credit'
            ])
            
            // ->add('typeAmortissement',TextType::class,[
            //     'label' => " Methode :",
            //     'required'=>false,
            // ])
            ->add('garant')
            // ->add('garantie')
            // ->add('Valeur')
            // ->add('Type')
            // ->add('ValeurUnitaure')
            // ->add('Unite')
            // ->add('ValeurTotal')
            ->add('cycles')
            ->add('CompteEpargne')
            // On recupere les donnees pour les patrimoines ici
            ->add('codecreditprecedent',TextType::class,[
                'mapped'=>false,
                'required'=>false
            ])
            ->add('Libelle1',TextType::class,[
                'label'=>'Libelle 1',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('Montant0',NumberType::class,[
                'label'=>'Montant 1',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('Libelle2',TextType::class,[
                'label'=>'Libelle 2',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('Montant2',NumberType::class,[
                'label'=>'Montant 2',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('Libelle3',TextType::class,[
                'label'=>'Libelle 3',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('Montant3',NumberType::class,[
                'label'=>'Montant 3',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('Libelle4',TextType::class,[
                'label'=>'Libelle 4',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('Montant4',NumberType::class,[
                'label'=>'Montant 4',
                'mapped'=>false,
                'required'=>false
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
