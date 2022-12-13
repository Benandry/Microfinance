<?php

namespace App\Form;

use App\Entity\Devise;
use App\Entity\FondCredit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FondCreditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NomBailleurs')
            ->add('Montant')
            ->add('date',DateType::class,[
                'widget'=>'single_text'
            ])
            ->add('devise',EntityType::class,[
                'class'=>Devise::class,
                'choice_label'=>'devise',
                'mapped'=>'true',
                'placeholder'=>'Devise'
            ])
            ->add('NumeroCompte')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FondCredit::class,
        ]);
    }
}
