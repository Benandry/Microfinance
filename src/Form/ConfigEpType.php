<?php

namespace App\Form;

use App\Entity\ConfigEp;
use App\Entity\Devise;
use App\Entity\PlanComptable;
use App\Entity\ProduitEpargne;
use App\Repository\ProduitEpargneRepository;
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
                'choice_label'=> function ($c){
                    return $c->getNomproduit()." (".$c->getAbbreviation().")";
                },
                'placeholder' =>'Choisissez un produit : ',
                'autocomplete'=>true,
                'label'=>'Nom Produit',
            ])
            ->add('IsNegatif',ChoiceType::class,[
                'choices'=>[
                    'Oui'=>1,
                    'Non'=>0
                ],
                'label'=>'Compte Negatif : ',
            ])
            ->add('statusProduit',CheckboxType::class,[
                'required' => false,
                'label' => "Activer "
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
                'label'=>'Nombre jour minimum retrait : ',
            ])
            ->add('NbrJrMaxDep',IntegerType::class,[
                'label'=>'Nombre maximum depot : ',
            ])
            ->add('ageMinCpt',IntegerType::class,[
                'label'=>'Age minimum ouvrir compte : ',
            ])
            ->add('soldeouvert',IntegerType::class,[
                'label'=>'Solde d\'ouverture : ',
            ])

            //  Comptabilite
            ->add('comptedebiteE',EntityType::class,[
                'label'=>'Compte debité : ',
                'class' => PlanComptable::class,
                'placeholder' => "Compte a debiter",
                'choice_label' => function($c) {
                    return $c->getNumeroCompte()." -- ".$c->getLibelle();
                },
                'autocomplete' => true,
            ])

            ->add('compteCrediteE',EntityType::class,[
                'label'=>'Compte credité : ',
                'class' => PlanComptable::class,
                'placeholder' => "Compte a crediter",
                'choice_label' => function($c) {
                    return $c->getNumeroCompte()." -- ".$c->getLibelle();
                },
                'autocomplete' => true,
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
