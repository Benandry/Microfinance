<?php

namespace App\Form;

use App\Entity\CompteEpargne;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltreRapportTransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('compteEpargne',EntityType::class,[
                'class' => CompteEpargne::class,
                'placeholder' => "Compte epargne",
                'attr' => [
                    'class' => 'form-control border-0'
                ],
                'choice_label' => 'codeepargne',
                'autocomplete' => true,
                'required' =>false,
                ])
            ->add('Du',DateType::class,[
                'widget'=>'single_text',
                'widget'=>'single_text',
                'format' => 'yyyy-MM-dd',
                'label'=> false,
                'mapped'=>true,
                'html5'=>true,
                'required' =>false,
                ])
                ->add('Au',DateType::class,[
                    'widget'=>'single_text',
                    'widget'=>'single_text',
                    'format' => 'yyyy-MM-dd',
                    'label'=> false,
                    'mapped'=>true,
                    'html5'=>true,
                    'required' =>false,
                ])

                ->add('date1',DateType::class,[
                    'widget'=>'single_text',
                    'widget'=>'single_text',
                    'format' => 'yyyy-MM-dd',
                    'label'=> false,
                    'mapped'=>true,
                    'html5'=>true,
                    'required' =>false,
                ])
            ->add('Filtre',SubmitType::class,[
                'attr'=>[
                    'class'=>'btn btn-primary'
                ],
                'label' => "Filtrer"
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
