<?php

namespace App\Form;

use App\Entity\Patrimoine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatrimoineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('IdClient')
            ->add('Libelle1')
            ->add('Montant1')
            ->add('Libelle2')
            ->add('Montant2')
            ->add('Montant3')
            ->add('Libelle3')
            ->add('Libelle4')
            ->add('Montant4')
            ->add('dateenregistrement',DateType::class,[
                'widget'=>'single_text'
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
