<?php

namespace App\Form;

use App\Entity\ConfigEp;
use App\Entity\Devise;
use App\Entity\ProduitEpargne;
use App\Repository\ProduitEpargneRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
                'choice_label'=> function ($c){
                    return $c->getNomproduit()." (".$c->getAbbreviation().")";
                },
                'query_builder' => function (ProduitEpargneRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->andWhere("p.isdesactive = 1 ");
                },
                'placeholder' =>'Choisissez un produit ',
                'autocomplete'=>true,
                'label'=>'Nom Produit',
            ])
            ->add('IsNegatif',ChoiceType::class,[
                'choices'=>[
                    'Oui'=>1,
                    'Non'=>0
                ],
                'label'=>'Compte Negatif',
            ])
            ->add('deviseutiliser',EntityType::class,[
                'class'=>Devise::class,
                'choice_label'=>'devise',
                'by_reference'=>TRUE,
                'attr'=>[
                    'class'=>'form-control',
                ]
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
