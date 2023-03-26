<?php

namespace App\Form;

use App\Entity\ConfigurationCredit;
use App\Entity\ProduitCredit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
                'label'=>'Interet Annuel',
                'required'=>false,
            ])
            // ->add('InteretRetard',IntegerType::class,[
            //     'label'=>'Interet de retard',
            //     'required'=>false
            // ])
            ->add('GarantieMoral',CheckboxType::class,[
                'label'=>'Garantie Moral',
                'required'=>false,
            ])
            ->add('GarantieMaterielle',CheckBoxType::class,[
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
                'label'=>'Penalite Payement Anticipé (Pourcentage)',
                'required'=>false,
            ])
            ->add('RetardPourcentage',IntegerType::class,[
                'label'=>'Penalite par pourcentage (Pourcentage)',
                'required'=>false
            ])
            ->add('PenaliteAnticipe',ChoiceType::class,[
                'label'=>'Penalite deduit par :',
                'placeholder'=>'Penalite Anticipe',
                'choices'=>[
                    'Capital'=>'Capital',
                    'Interet'=>'Interet',
                    'Credit Restant'=>'Credit Restant',
                ],
                'required'=>false,
            ])
            ->add('PenalitePourcentage',ChoiceType::class,[
                'label'=>'Penalite deduit par :',
                'placeholder'=>'Penalite Pourcentage',
                'choices'=>[
                    'Capital'=>'Capital',
                    'Interet'=>'Interet',
                    'Credit Restant'=>'Credit Restant',
                ],
                'required'=>false,
            ])
            // ->add('PenaliteCapital',RadioType::class,[
            //     'label'=>'Penalite deduit par la capital',
            //     'mapped'=>false,
            //     'required'=>false
            // ])
            // ->add('PenaliteInteret',RadioType::class,[
            //     'label'=>'Penalite deduit par l\'interet',
            //     'mapped'=>false,
            //     'required'=>false
            // ])
            // ->add('PenaliteCRD',RadioType::class,[
            //     'label'=>'Penalite deduit par le credit restant du',
            //     'mapped'=>false,
            //     'required'=>false
            // ])
            ->add('RetardForfaitaire',IntegerType::class,[
                'label'=>'Forfaitaire',
                'required'=>false
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
