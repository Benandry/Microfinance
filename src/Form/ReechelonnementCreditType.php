<?php

namespace App\Form;

use App\Entity\ReechelonnementCredit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReechelonnementCreditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NumeroCredit',TextType::class,[
                'required'=>false
            ])
            ->add('CodeClient',TextType::class,[
                'required'=>false
            ])
            // ->add('ResteCredit',IntegerType::class,[
            //     'required'=>false
            // ])
            // ->add('RestePeriode',IntegerType::class,[
            //     'required'=>false
            // ])
            // ->add('ResteCapital',IntegerType::class,[
            //     'required'=>false
            // ])
            // ->add('ResteInteret',IntegerType::class,[
            //     'required'=>false
            // ])
            ->add('DateDuJour',DateType::class,[
                'widget'=>'single_text'
            ])
            ->add('DateReechelonner',DateType::class,[
                'widget'=>'single_text'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReechelonnementCredit::class,
        ]);
    }
}
