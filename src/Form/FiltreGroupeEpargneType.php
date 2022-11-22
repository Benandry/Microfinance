<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltreGroupeEpargneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Date1',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Du',
                'mapped'=>true,
                'by_reference'=>true
                ])
                ->add('Date2',DateType::class,[
                    'widget'=>'single_text',
                    'label'=>'Au',
                    'mapped'=>true,
            ])
            ->add('Filtre',SubmitType::class,[
                'attr'=>[
                    'class'=>'btn btn-success'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
