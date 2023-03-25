<?php

namespace App\Form;

use App\Entity\DemandeCredit;
use App\Repository\DemandeCreditRepository;
use PhpParser\Node\Expr\FuncCall;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FicheCreditModalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('CodeCredit',EntityType::class,[
            'class'=>DemandeCredit::class,
            'placeholder'=>'Choisir un numero',
            'choice_label'=>function ($fiche){
                return $fiche->getNumeroCredit();
            },
            'query_builder'=>function(DemandeCreditRepository $fiche){
                return $fiche->createQueryBuilder('d')
                    ->setMaxResults(5);
            },
            'autocomplete'=>true
        ])
        ->add('NumeroCredit');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([

        ]);
    }
}