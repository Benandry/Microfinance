<?php

namespace App\Form;

use App\Entity\Analytique;
use App\Entity\Decaissement;
use App\Entity\PlanComptable;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DecaissementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numeroCredit')
            ->add('montantCredit')
            ->add('dateDecaissement',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Date de decaissement : ',
                'mapped'=>true,
                'by_reference'=>true
                ])
            ->add('pieceComptable')
            // ->add('fraisPapeterie')
            ->add('commissionCredit')
            ->add('fraisDeDeveloppement')
            ->add('cash')
            // ->add('debit',EntityType::class,[
            //     'class' => PlanComptable::class,
            //     'choice_label' => function($c){
            //         return $c->getNumeroCompte().' - '.$c->getLibelle();
            //     },
            //     'label'=>'Compte debit :',
            //     'mapped'=>false,
            //     'placeholder'=>"Compte debit ... ",
            //     'required' => false,
            //     'autocomplete' => true,
            // ])

            // ->add('credit',EntityType::class,[
            //         'class' => PlanComptable::class,
            //         'choice_label' => function($c){
            //             return $c->getNumeroCompte().' - '.$c->getLibelle();
            //         },
            //     'label'=>'Compte credit :',
            //     'mapped'=>false,
            //     'required' => false,
            //     'autocomplete' => true,
            //     'placeholder'=>"Compte credit ... ",
            // ])

            // ->add('debitAnalytique',EntityType::class,[
            //     'class' => Analytique ::class,
            //     'choice_label' => function($c){
            //         return $c->getCode().' - '.$c->getLibelle();
            //     },
            //     'label'=>'Compte debit :',
            //     'mapped'=>false,
            //     'placeholder'=>"Compte debit ... ",
            //     'required' => false,
            //     'autocomplete' => true,
            // ])
            // ->add('creditAnalytique',EntityType::class,[
            //     'class' => Analytique ::class,
            //     'choice_label' => function($c){
            //         return $c->getCode().' - '.$c->getLibelle();
            //     },
            //     'label'=>'Compte debit :',
            //     'mapped'=>false,
            //     'placeholder'=>"Compte debit ... ",
            //     'required' => false,
            //     'autocomplete' => true,
            // ])
            ->add('NumeroCompteEpargne',TextType::class,[
                'required'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Decaissement::class,
        ]);
    }
}
