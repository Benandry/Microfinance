<?php

namespace App\Form;

use App\Entity\GarantieCredit;
use App\Entity\ProduitCredit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('MontantExige',IntegerType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Montant exiger . . .'
                ],
                'required'=>false

            ])
            ->add('regle',ChoiceType::class,[
                'label'=>false,
                'choices'=>[
                    'Demande'=>'Demande',
                    'Approbation'=>'Approbation',
                    'Remmboursement'=>'Remboursement'
                ],
                'attr'=>[
                    'placeholder'=>'Regle'
                ],
                'required'=>false
            ])
            ->add('GarantObligatoireCreditInd',RadioType::class,[
                'label'=>'Garant obligatoire  (Individuel)',
                'disabled'=>false,
                'required'=>false
            ])
            ->add('MontantGarant',IntegerType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Montant Garant'
                ],
                'required'=>false
            ])
            ->add('GarantObligatoireCreditGrp',RadioType::class,[
                'label'=>'Garant obligatoire  (Groupe)',
                'disabled'=>false,
                'required'=>false
            ])
            ->add('MontantGarantieGrp',IntegerType::class,[
                'label'=>false,
                'disabled'=>false,
                'required'=>false,
                'attr'=>[
                    'placeholder'=>'Montant Garantie groupe'
                ]
            ])
            ->add('reglegrp',ChoiceType::class,[
                'choices'=>[
                    'Demandes'=>'Demandes',
                    'Approbation'=>'Approbation',
                    'Remboursement'=>'Remboursement'
                ],
                'attr'=>[
                    'placeholder'=>'Choix regles',
                    'class'=>'form-control'
                ],
                'label'=>false,
                'required'=>false
            ])
            ->add('ProduitCredit',EntityType::class,[
                'class'=>ProduitCredit::class,
                'choice_label'=>'NomProduitCredit',
                'mapped'=>true,
                'by_reference'=>true,
                'placeholder'=>'Type credit',
                'required'=>false
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
