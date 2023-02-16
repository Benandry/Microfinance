<?php

namespace App\Form;

use App\Entity\Groupe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltreRapportGroupeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('one_date_search',DateType::class,[
                'widget'=>'single_text',
                'label'=>false,
                'required' =>false,
            ])
            ->add('Date1',DateType::class,[
                'widget'=>'single_text',
                'label'=>false,
                'required' =>false,
            ])
            ->add('Date2',DateType::class,[
                'widget'=>'single_text',
                'label'=>false,
                'required' =>false,
            ])
            ->add('Chercher',SubmitType::class,[
                'attr'=>[
                    'class'=>'btn btn-primary',
                    ],
                'label' => "Filtrer"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // 'data_class' => Groupe::class,
        ]);
    }
}
