<?php

namespace App\Form;

use App\Entity\Patrimoine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatrimoineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('IdClient')
            ->add('Libelle1',TextType::class,[
                'label' => 'Libelle 1 :'
            ])
            ->add('Montant1',NumberType::class,[
                'label' => "Montant 1 : "
            ])
            ->add('Libelle2',TextType::class,[
                'label' =>'Libelle 2 :'
            ])
            ->add('Montant2',NumberType::class,[
                'label' => "Montant 2 : "
            ])
            ->add('Montant3',NumberType::class,[
                'label' => "Montant 3 : "
            ])
            ->add('Libelle3',TextType::class,[
                'label' =>'Libelle 3 :'
            ])
            ->add('Libelle4',TextType::class,[
                'label' => 'Libelle 4 :'
            ])
            ->add('Montant4',NumberType::class,[
                'label' => "Montant 4: "
            ])
            ->add('dateenregistrement',DateType::class,[
                'widget'=>'single_text',
                'label' => "Date d'enregistrement : "
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patrimoine::class,
        ]);
    }
}
