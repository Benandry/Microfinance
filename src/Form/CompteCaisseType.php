<?php

namespace App\Form;

use App\Entity\Agence;
use App\Entity\CompteCaisse;
use App\Entity\PlanComptable;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompteCaisseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomCaisse',TextType::class,[
                'label' => "Nom du caisse : ",
            ])

            ->add('planComptable',EntityType::class,[
                'class' => PlanComptable::class,
                'choice_label' => function($plan){
                    return $plan->getNumeroCompte()." ".$plan->getLibelle();
                },
                'attr' => [
                    'class' => 'border-0',
                ],
                'autocomplete' => true,
                'label' => "Plan Comptable : ",
                'placeholder' => "Plan comptable : "
            ])
            ->add('codecaisse')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CompteCaisse::class,
        ]);
    }
}
