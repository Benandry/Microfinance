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
            ->add('InteretRetard',IntegerType::class,[
                'label'=>'Interet de retard',
                'required'=>false
            ])
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
                'label'=>'Penalite Payement Anticipé(deduit dans tous les credits)',
                'required'=>false,
            ])
            ->add('RetardPourcentage',IntegerType::class,[
                'label'=>'Penalite par pourcentage(deduit dans tous les credits)',
                'required'=>false
            ])
            // ->add('PayementAnticipe',IntegerType::class,[
            //     'label'=>'P'
            // ])
            ->add('RetardForfaitaire',IntegerType::class,[
                'label'=>'Forfaitaire',
                'required'=>false
            ])
            ->add('RetardPeriode',IntegerType::class,[
                'label'=>'Retard par periode(Deduit dans tous les credits)',
                'required'=>false
            ])
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
