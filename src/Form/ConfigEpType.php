<?php

namespace App\Form;

use App\Entity\ConfigEp;
use App\Entity\Devise;
use App\Entity\ProduitEpargne;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigEpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('produitEpargne',EntityType::class,[
                'class'=>ProduitEpargne::class,
                'choice_label'=>'nomproduit',
                'by_reference'=>false,
                'mapped'=>true,
                'label'=>'Produit',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('IsNegatif',ChoiceType::class,[
                'required'=>false,
                'choices'=>[
                    'Oui'=>1,
                    'Non'=>0
                ],
                'label'=>'Compte Negatif',
                'attr'=>[
                    'class'=>'form-control',
                    ]
                    ])
            ->add('deviseutiliser',EntityType::class,[
                'class'=>Devise::class,
                'choice_label'=>'devise',
                'by_reference'=>TRUE,
                'attr'=>[
                    'class'=>'form-control',
                ]
            ])
            ->add('nbrjInactif',IntegerType::class,[
                'label'=>'Nombre jour inactif',
            ])
            ->add('nbMinRet',IntegerType::class,[
                'label'=>'Nombre jour minimum retrait',
            ])
            ->add('NbrJrMaxDep',IntegerType::class,[
                'label'=>'Nombre maximum depot',
            ])
            ->add('ageMinCpt',IntegerType::class,[
                'label'=>'Age minimum ouvrir compte',
            ])
            ->add('fraisTenuCpt',IntegerType::class,[
                'label'=>'Frais tenu compte',
            ])
            ->add('commissionRetCash',IntegerType::class,[
                'label'=>'Commission retrait cash',
            ])
            ->add('commissionTransf',IntegerType::class,[
                'label'=>'Commission transaction',
            ])
            ->add('fraisFermCpt',IntegerType::class,[
                'label'=>'Frais compte tenu',
            ])
            ->add('soldeouvert',IntegerType::class,[
                'label'=>'Solde d\'ouverture',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ConfigEp::class,
        ]);
    }
}
