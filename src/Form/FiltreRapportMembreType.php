<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltreRapportMembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                ->add('search_on_date',DateType::class,[
                    'widget'=>'single_text',
                    'format' => 'yyyy-MM-dd',
                    'label'=>'Par un date',
                    'mapped'=>true,
                    'required' => false,
                    'html5'=>true,
                ])
                ->add('Du',DateType::class,[
                    'widget'=>'single_text',
                    'format' => 'yyyy-MM-dd',
                    'label'=>'Du',
                    'mapped'=>true,
                    'html5'=>true,
                    'required' => false,
                ])
                ->add('Au',DateType::class,[
                    'widget'=>'single_text',
                    'format' => 'yyyy-MM-dd',
                    'label'=>'Au',
                    'mapped'=>true,
                    'html5'=>true,
                    'required' => false,
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
