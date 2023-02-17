<?php

namespace App\Form;

use App\Entity\ConfigurationCredit;
use App\Entity\ProduitCredit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigurationCreditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ProduitCredit',EntityType::class,[
                'class'=>ProduitCredit::class,
                'choice_label'=>'NomProduitCredit',
                'placeholder'=>'Choisir produit credit'
            ])
            ->add('Methode',ChoiceType::class,[
                'placeholder'=>'Choisir Methode',
                'choices'=>[
                    'Lineaire'=>'Lineaire',
                    'Degressif'=>'Degressif'
                ]
                            ])
            ->add('Montant',IntegerType::class,[
                'label'=>'Montant Maximum',
                'required'=>false,
            ])
            ->add('Tranche',IntegerType::class,[
                'required'=>false
            ])
            ->add('MontantMin',IntegerType::class,[
                'label'=>'Montant Minimum',
                'required'=>false,
            ])
            ->add('InteretNormal',IntegerType::class,[
                'label'=>'Interet Normal',
                'required'=>false,
            ])
            // ->add('InteretDegressif',IntegerType::class,[
            //     'label'=>'Interet Degressif'
            // ])
            // ->add('InteretLineaire',IntegerType::class,[
            //     'label'=>'Interet Lineaire',
            //     'required'=>false,
            // ])
            ->add('GarantieMoral',RadioType::class,[
                'label'=>'Garantie Moral',
                'required'=>false,
            ])
            ->add('GarantieMaterielle',RadioType::class,[
                'label'=>'Garantie Materielle',
                'required'=>false,
            ])
            ->add('TauxGarantieMaterielle',IntegerType::class,[
                'label'=>'Garantie Materielle (%)',
                'required'=>false,
            ])
            ->add('GarantieFinanciere',RadioType::class,[
                'label'=>'Garantie Financiere',
                'required'=>false,
            ])
            ->add('TauxGarantieFinanciere',IntegerType::class,[
                'label'=>'Garantie Financiere (%)',
                'required'=>false,
            ])
            ->add('FraisDossier')
            ->add('FraisCommission')
            ->add('FraisPapeterie')
            ->add('PenaliteDiminutionIntrt',IntegerType::class,[
                'label'=>'Penalite Diminution Interet',
                'required'=>false,
            ])
            ->add('PenalitePayementAntcp',IntegerType::class,[
                'label'=>'Penalite Payement Anticipé',
                'required'=>false,
            ])
            ->add('RetardPourcentage')
            ->add('PayementAnticipe')
            ->add('RetardForfaitaire')
            ->add('RetardPeriode')
            ->add('RetardPeriodeJour',RadioType::class,[
                'label'=>'Retard Periode Jour',
                'required'=>false,
            ])
            ->add('RetardPeriodeMois',RadioType::class,[
                'label'=>'Retard Periode Mois',
                'required'=>false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ConfigurationCredit::class,
        ]);
    }
}
