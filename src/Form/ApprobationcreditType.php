<?php

namespace App\Form;

use App\Entity\DemandeCredit;
use App\Entity\ApprobationCredit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
            ->add('utilisateur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ApprobationCredit::class,
        ]);
    }
}
