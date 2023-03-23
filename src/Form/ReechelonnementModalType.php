<?php

namespace App\Form;

use App\Entity\Decaissement;
use App\Entity\DemandeCredit;
use App\Repository\DecaissementRepository;
use App\Repository\DemandeCreditRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReechelonnementModalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
        ->add('CodeCredit',EntityType::class,[
            'class'=>DemandeCredit::class,
            'label'=>'Numero Credit',
            'placeholder'=>'Choisir client',
            'choice_label'=>function($remboursement){
                return $remboursement->getNumeroCredit();
            },
            'query_builder'=>function(DemandeCreditRepository $remboursement){
                return $remboursement->createQueryBuilder('r')
                        ->setMaxResults(5);
            },
            'autocomplete'=>true
])
        ->add('nom',TextType::class,[
            'required'=>false
        ])
        ->add('prenom',TextType::class,[
            'required'=>false
        ])
        ->add('codeclient',TextType::class,[
            'required'=>false
        ])
        ->add('NumeroCredit',TextType::class,[
            'required'=>false
        ])
        ->add('ResteCapital',TextType::class,[
            'required'=>false
        ])
        ->add('ResteInteret',TextType::class,[
            'required'=>false
        ])
        ->add('SommeDejaRembourser',TextType::class,[
            'required'=>false
        ])
        ->add('Periode',TextType::class,[
            'required'=>false
        ])
        ->add('DernierPeriode',TextType::class,[
            'required'=>false
        ])
        ->add('MontantDecaisser',TextType::class,[
            'required'=>false
        ])
        ->add('InteretCredit',TextType::class,[
            'required'=>false
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([

        ]);
    }
}