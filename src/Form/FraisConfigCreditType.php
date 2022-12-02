<?php

namespace App\Form;

use App\Entity\FraisConfigCredit;
use App\Entity\ProduitCredit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FraisConfigCreditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ProduitCredit',EntityType::class,[
                'class'=>ProduitCredit::class,
                'choice_label'=>'NomProduitCredit',
                'mapped'=>true,
                'by_reference'=>true,
                'placeholder'=>'Choisir Produit Credit',
                'attr'=>[
                    'class'=>'form-control',
                ]
            ])
            ->add('TypeClient',ChoiceType::class,[
                'choices'=>[
                    'INDIVIDUEL'=>'INDIVIDUEL',
                    'GROUPE'=>'GROUPE'
                ]
            ]
            )
            ->add('Papeterie')
            ->add('Commission')
            ->add('FraisDeDeveloppement')
            ->add('FraisDeRefinancement')
            ->add('CommissionCreditChaqueTrancheInd')
            ->add('DroitTimbreSurCapital')
            ->add('SurInteretCours')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FraisConfigCredit::class,
        ]);
    }
}
