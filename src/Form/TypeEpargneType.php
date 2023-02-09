<?php

namespace App\Form;

use App\Entity\TypeEpargne;
use Symfony\Component\Form\AbstractType;
<<<<<<< HEAD
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
=======
>>>>>>> refs/remotes/origin/main
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeEpargneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NomTypeEp',TextType::class,[
                'label'=>'Type epargne',
            ])
<<<<<<< HEAD
            ->add('abreviation',ChoiceType::class,[
                'placeholder' => "Type de client ...",
                'choices'=>[ 
                    'DAV -- Depot a vue'=>'DAV',
                    'DAT -- Dépôts à terme'=>'DAT',
                    'DA -- Depot Salaire'=>'DA',
                    'PEP -- Compte d\'épargne à régime spécial' => 'PEP',
                    'BDC -- Bon de Caisse' => 'BDC',
                    'DDG -- Dépôts de garantie' => 'DDG',
                    'autre produit epargne' => 'Autre'
                ],
            ])
=======
            ->add('abreviation')
>>>>>>> refs/remotes/origin/main
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TypeEpargne::class,
        ]);
    }
}
