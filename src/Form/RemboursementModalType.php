<?php

namespace App\Form;

use App\Entity\Decaissement;
use App\Entity\RemboursementCredit;
use App\Repository\DecaissementRepository;
use App\Repository\RemboursementCreditRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RemboursementModalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeclient',ChoiceType::class,[
                'placeholder'=>'Choisir type Client',
                'label'=>'Type cllent',
                'choices'=>[
                    'INDIVIDUEL'=>'INDIVIDUEL',
                    'GROUPE'=>'GROUPE',
                ]
            ])
            ->add('codecredit',EntityType::class,[
                'class'=>Decaissement::class,
                'label'=>'Numero Credit',
                'placeholder'=>'Choisir client',
                'choice_label'=>function($remboursement){
                    return $remboursement->getNumeroCredit();
                },
                'query_builder'=>function(DecaissementRepository $remboursement){
                    return $remboursement->createQueryBuilder('r')
                            ->setMaxResults(5);
                },
                'autocomplete'=>true
            ])
            ->add('numerocredit')
            ->add('Mode',ChoiceType::class,[
                'placeholder'=>'Mode de paiement',
                'choices'=>[
                    'ESPECE'=>'ESPECE',
                    'DAG'=>'DAG'
                ]
            ])
            ->add('penaliteprecedent',TextType::class,[
                    'required'=>false
            ])
            ->add('montantprecedent',TextType::class,[
                    'required'=>false
            ])
            ->add('montantdu',TextType::class,[
                'required'=>false
            ]) 
            ->add('periode',TextType::class,[
                'required'=>false
            ])
            ->add('restemontant',TextType::class,[
                'required'=>false
            ])
            ->add('crd',TextType::class,[
                'required'=>false
            ])
            ->add('TotalRembourser',TextType::class,[
                'required'=>false
            ])
            ->add('TotalaRembourser',TextType::class,[
                'required'=>false
            ])
            ->add('TotalPeriode',TextType::class,[
                'required'=>false
            ])
            ->add('capital')
            ->add('interet')
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
