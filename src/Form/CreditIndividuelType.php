<?php

namespace App\Form;

use App\Entity\CreditIndividuel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreditIndividuelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('TauxInteretAnnuel',IntegerType::class)
            ->add('DifferementPayement',IntegerType::class)
            ->add('Tranche',IntegerType::class)
            ->add('TypeTranche',ChoiceType::class,[
                'choices'=>[
                    'HEBDOMADAIRE'=>'HEBDOMADAIRE',
                    'MENSUEL'=>'MENSUEL',
                    'TRIMESTRIEL'=>'TRIMESTRIEL',
                    'BIMESTRIEL'=>'BIMESTRIEL',
                    'ANNUEL'=>'ANNUEL',
                ],
                'placeholder'=>'Type tranches'
            ])
            ->add('CalculInteret',IntegerType::class)
            ->add('MontantMinimumCredit',IntegerType::class)
            ->add('MontantMaximumCredit',IntegerType::class)
            ->add('DelaisDeGraceMaxi',IntegerType::class)
            ->add('PaiementPrealableInteret')
            ->add('CalculIntertPourDiffere')
            ->add('IntaretDifferePaiementCapitalise')
            ->add('InteretPayerDiffere')
            ->add('TrancheDistinctInteret')
            ->add('InteretDeductDecaissement')
            ->add('CalculInteretJours')
            ->add('ForfaitPaiementPrealableInteret')
            ->add('PeriodeMinimumCredit')
            ->add('PeriodeMaximumCredit')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreditIndividuel::class,
        ]);
    }
}
