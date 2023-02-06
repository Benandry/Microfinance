<?php

namespace App\Form;

use App\Entity\Analytique;
use App\Entity\MouvementComptable;
use App\Entity\PlanBudget;
use App\Entity\PlanComptable;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MouvementComptableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateMouvement',DateType::class,[
                'widget'=>'single_text',
            ])
            ->add('description',TextType::class,[
                'label' => "Description de mouvement :"
            ])
            ->add('montant',NumberType::class,[
                'label' => "Montant : ",
                'mapped' => false
                
            ])
            ->add('pieceComptable')
            ->add('debit',EntityType::class,[
                'class' => PlanComptable::class,
                'choice_label' => function($c){
                    return $c->getNumeroCompte().' - '.$c->getLibelle();
                },
                'label'=>'Compte credit :',
                'mapped'=>false,
                'required' => false,
                'autocomplete' => true,
                'placeholder'=>"Compte credit ... ",
            ])

            ->add('credit',EntityType::class,[
                'class' => PlanComptable::class,
                'choice_label' => function($c){
                    return $c->getNumeroCompte().' - '.$c->getLibelle();
                },
                'label'=>'Compte credit :',
                'mapped'=>false,
                'required' => false,
                'autocomplete' => true,
                'placeholder'=>"Compte credit ... ",
            ])
            
            ->add('analytique',EntityType::class,[
                'class' => Analytique::class,
                'choice_label' => function($c){
                    return $c->getCode().' - '.$c->getLibelle();
                },
                'label'=>'Plan analytique :',
                'mapped'=>false,
                'required' => false,
                'autocomplete' => true,
                'placeholder'=>"... ",
            ])
            
            ->add('budgetaire',EntityType::class,[
                'class' => PlanBudget::class,
                'choice_label' => function($c){
                    return $c->getCode().' - '.$c->getTitre();
                },
                'label'=>'Plan budgetaire :',
                'mapped'=>false,
                'required' => false,
                'autocomplete' => true,
                'placeholder'=>"... ",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MouvementComptable::class,
        ]);
    }
}
