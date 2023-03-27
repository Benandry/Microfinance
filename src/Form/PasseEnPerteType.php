<?php

namespace App\Form;

use App\Entity\PasseEnPerte;
use App\Entity\RemboursementCredit;
use App\Repository\RemboursementCreditRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PasseEnPerteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NumeroCredit')
            ->add('PasseEnPerte')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PasseEnPerte::class,
        ]);
    }
}
