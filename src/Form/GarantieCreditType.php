<?php

namespace App\Form;

use App\Entity\GarantieCredit;
use App\Entity\ProduitCredit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GarantieCreditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('CreditBaseEpargne')
            ->add('MontantCreditDmdIndividuel',IntegerType::class,[
                    'label'=>'% Montant credit demande (Individuel)',
                    'disabled'=>true,
                    'required'=>false

            ])
            ->add('MontantCreditDmdGroupe',IntegerType::class,[
                'label'=>'% Montant credit demande (Groupe)',
                'disabled'=>true,
                'required'=>false
            ])
            ->add('MontantCrdAnciensCreditenCours',IntegerType::class,[
                'label'=>'% Montant ancien credit en cours (Individuel)',
                'disabled'=>true,
                'required'=>false
            ])
            ->add('MontantCrdAnciensCreditenCoursGrp',IntegerType::class,[
                'label'=>'% Montant ancien credit en cours (Groupe)',
                'disabled'=>true,
                'required'=>false
            ])
            ->add('GarantieBaseMontantCredit',RadioType::class,[
                'disabled'=>true,
                'required'=>false
                ])
                ->add('DeduireGarantieAuDecaissement',RadioType::class,[
                    'label'=>'Deduire garantie au decaissement (Individuel)',
                    'disabled'=>true,
                    'required'=>false
            ])
            ->add('DeduireGarantieAuDecaissementGrp',RadioType::class,[
                'label'=>'Deduire garantie au decaissement (Groupe)',
                'disabled'=>true,
                'required'=>false
            ])
            ->add('GarantieObligatoireCreditInd',RadioType::class,[
                'label'=>'Garantie obligatoire  (Individuel)',
                'disabled'=>false,
                'required'=>false
            ])
            ->add('MontantExige',IntegerType::class)
            ->add('regle')
            ->add('GarantObligatoireCreditInd',RadioType::class,[
                'label'=>'Garant obligatoire  (Individuel)',
                'disabled'=>false,
                'required'=>false
            ])
            ->add('MontantGarant')
            ->add('GarantObligatoireCreditGrp',RadioType::class,[
                'label'=>'Garant obligatoire  (Groupe)',
                'disabled'=>false,
                'required'=>false
            ])
            ->add('MontantGarantieGrp',IntegerType::class,[
                'label'=>'Montant garantie  (Groupe)',
                'disabled'=>true,
                'required'=>false
            ])
            ->add('reglegrp',ChoiceType::class,[
                'placeholder'=>'Choix regles',
                'choices'=>[
                    'Demandes'=>'Demandes',
                    'Approbation'=>'Approbation',
                    'Remboursement'=>'Remboursement'
                ],
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'Regle appliqué'
            ])
            ->add('ProduitEpargne',EntityType::class,[
                'class'=>ProduitCredit::class,
                'choice_label'=>'NomProduitCredit',
                'mapped'=>true,
                'by_reference'=>true,
                'placeholder'=>'Type credit'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GarantieCredit::class,
        ]);
    }
}
