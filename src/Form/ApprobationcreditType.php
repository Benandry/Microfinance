<?php

namespace App\Form;

use App\Entity\DemandeCredit;
use App\Entity\User;
use App\Entity\ApprobationCredit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ApprobationCreditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateApprobation',DateType :: class,[
                'label' => "Date d'approbation :",
                'widget' => 'single_text',
            ])
            ->add('description')
            ->add('statusApprobation',ChoiceType:: class,[
                'choices'  => [
                    'approuvé' => "approuvé",
                    'Rejeté' => 'Rejeté',
                    'Différée' => "Différée",
                ],
                'label' => "Status"
            ])
            ->add('montant',TextType::class,[
                'label' => 'Montant du credit',
            ])
            
            ->add('codecredit',TextType::class,[
                'label' => 'Code credit',
            ])
<<<<<<< HEAD
            ->add('agentCredit',EntityType::class,[
                'class'=>User::class,
                'choice_label'=>'prenom',
                'by_reference'=>true,
                'placeholder'=>'Agent de credit . . .',
                'attr'=>[
                    'class'=>'form-control'
                 ]
                ])
=======
            ->add('agentCredit')
>>>>>>> 410ee134f89a13a0d263c507d2b256126d354a93
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ApprobationCredit::class,
        ]);
    }
}
