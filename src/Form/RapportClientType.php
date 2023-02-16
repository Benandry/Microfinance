<?php

namespace App\Form;

use App\Entity\Agence;
use App\Entity\Commune;
use App\Entity\Groupe;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomAgence',EntityType::class,[
                'class' => Agence::class,
                'autocomplete' => true,
                'placeholder' => "Agences ...",
                'label' => "Agences :",
                'choice_label' => 'NomAgence',
                'required' => false
            ])
            ->add('groupe',EntityType::class,[
                'class' => Groupe::class,
                'autocomplete' => true,
                'placeholder' => "Groupe ",
                'label' => "Membre du groupe : ",
                'choice_label' => 'nomGroupe',
                'required' => false
            ])
            ->add('commune',EntityType::class,[
                'class' => Commune::class,
                'autocomplete' => true,
                'placeholder' => "Commune ...",
                'label' => "Commune : ",
                'choice_label' => 'NomCommune',
                'required' => false
            ])
            ->add('search_one_date',DateType::class,[
                'widget'=>'single_text',
                'label'=> false,
                'required' => false
            ])
            ->add('date1',DateType::class,[
                'widget'=>'single_text',
                'label'=> false,
                'required' => false
            ])

            ->add('date2',DateType::class,[
                'widget'=>'single_text',
                'label'=> false,
                'required' => false
            ])
            
            ->add('agent',EntityType::class,[
                'class' => User::class,
                'choice_label' => function ($c){
                    return $c->getNom().' '.$c->getPrenom();
                },
                'autocomplete' => true,
                'required' => false,
                'label' => "Agent :"
            ])

            

            ->add('Chercher',SubmitType::class,[
                'attr'=>[
                    'class'=>'btn btn-primary btn-sm'
                ],
                'label' => 'Filtrer '
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
