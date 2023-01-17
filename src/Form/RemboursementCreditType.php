<?php

namespace App\Form;

use App\Entity\PlanComptable;
use App\Entity\RemboursementCredit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RemboursementCreditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NumeroCredit')
            ->add('DateRemboursement',DateType::class,[
                'widget'=>'single_text'
            ])
            ->add('PieceCompteble')
            ->add('MontantTotalPaye')
            ->add('Papeterie')
            ->add('TransactionEnLiquide')
            ->add('TransfertEpargne')
            ->add('periode')
            ->add('Caisse',EntityType::class,[
                'class'=>PlanComptable::class,
                'choice_label'=>'Libelle',
                'placeholder'=>'Choix caisse'
            ])
            ->add('penalite')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RemboursementCredit::class,
        ]);
    }
}
