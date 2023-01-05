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
                'format' => 'yyyy-MM-dd',
                'label'=>' ',
                'mapped'=>true,
                'html5'=>true,
                'required' =>false,
            ])
            ->add('Date1',DateType::class,[
                    'widget'=>'single_text',
                    'format' => 'yyyy-MM-dd',
                    'label'=>'Du',
                    'mapped'=>true,
                    'html5'=>true,
                    'required' =>false,
                ])
                ->add('Date2',DateType::class,[
                    'widget'=>'single_text',
                    'format' => 'yyyy-MM-dd',
                    'label'=>'Au',
                    'mapped'=>true,
                    'html5'=>true,
                    'required' =>false,
                ])
            ->add('Chercher',SubmitType::class,[
                'attr'=>[
                    'class'=>'btn btn-primary btn-sm',
                    ],
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
