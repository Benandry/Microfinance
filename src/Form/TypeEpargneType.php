<?php

namespace App\Form;

use App\Entity\TypeEpargne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('abreviation',ChoiceType::class,[
                'placeholder' => "Type de client ...",
                'choices'=>[
                    'DAV'=>'DAV',
                    'DAT'=>'DAT',
                    'DA'=>'DA',
                    'PEP' => 'PEP',
                    'BDC' => 'BDC',
                    'DDG' => 'DDG',
                    'Autre' => 'autre produit epargne '
                ],
            ])
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
