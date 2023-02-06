<?php

namespace App\Form;

use App\Entity\CompteEpargne;
use App\Entity\PlanComptable;
use App\Entity\Transaction;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransactionretraitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Description',TextType::class,[
                'attr'=>[
                    'value'=>'RETRAIT'
                ]
            ])
            ->add('typeClient',TextType::class,[
                
                'attr'=>[
                    'class'=>'form-control',
                    'value'=>'GROUPE'
                ]
            ])
            ->add('PieceComptable')
            ->add('DateTransaction',DateType::class,[
                'widget'=>'single_text',
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'Date'
            ])
            ->add('Montant',IntegerType::class,[
                'label'=>'Montant',
                'required'=>false,
                'attr'=>[
                    'class'=>'form-control'
                    ]
                ])

                ->add('montant_bruite',IntegerType::class,[
                    'label' => "Montant bruite",
                    'mapped' => false,
                    'attr'=>[
                        'class'=>'form-control'
                    ],])
                    
            ->add('papeterie',IntegerType::class)
            ->add('commission',IntegerType::class)        
            ->add('codeepargneclient',TextType::class,[
                'label' => "Compte Epargne",
                'attr'=>[
                    'class'=>'form-control',
                    'placeholder'=>'Code client . . .'
                ],
            ])

            ->add('solde',TextType::class,[
                'attr'=>[
                    'class'=>'hidden'
                ]
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}