<?php

namespace App\Form;

use App\Entity\RemboursementCredit;
use App\Repository\RemboursementCreditRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PasseEnPerteModalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('NumeroCredit',EntityType::class,[
            'class'=>RemboursementCredit::class,
            'label'=>'Numero Credit',
            'placeholder'=>'Choiseir numero credit',
            'choice_label'=>function ($perte){
                return $perte->getNumeroCredit();
            },
            'query_builder'=>function (RemboursementCreditRepository $perte){
                return $perte->createQueryBuilder('p');
            },
            'autocomplete'=>true
        ])
        ->add('CodeCredit')
        ->add('CodeClient')
        ->add('NomClient')
        ->add('PrenomClient')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([

        ]);
    }
}