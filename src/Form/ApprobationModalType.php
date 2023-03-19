<?php

namespace App\Form;

use App\Entity\DemandeCredit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApprobationModalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('CodeCredit',EntityType::class,[
            'class'=>DemandeCredit::class,
            'placeholder'=>'Choisir un client',
            'label'=>'Numero Creidit',
            'choice_label'=>function ($numerocredit){
                return $numerocredit->getNumeroCredit();
            },
            'query_builder'=>function ($numerocredit){
                return $numerocredit->createQueryBuilder('a');
            },
            'autocomplete'=>true
        ])
        ->add('NumeroCredit',TextType::class,[
            'required'=>false
        ])
        ->add('TauxInteretAnnuel',IntegerType::class,[
            'required'=>false
        ])
        ->add('Cycle',IntegerType::class,[
            'required'=>false
        ])
        ->add('NombreTranche',IntegerType::class,[
            'required'=>false
        ])
        ->add('TypeTranche',TextType::class,[
            'required'=>false
        ])
        ->add('Montant',IntegerType::class,[
            'required'=>false
        ])
        ->add('CodeClient',TextType::class,[
            'required'=>false
        ])
        ->add('NomClient',TextType::class,[
            'required'=>false
        ])
        ->add('PrenomClient',TextType::class,[
            'required'=>false
        ]);
    }   
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([

        ]);
    }
}