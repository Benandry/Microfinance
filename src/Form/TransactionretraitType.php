<?php

namespace App\Form;

use App\Entity\CompteEpargne;
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
            ->add('Description',ChoiceType::class,[
                'choices'=>[
                    'RETRAIT'=>'RETRAIT'
                ],
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('typeClient',ChoiceType::class,[
                'choices'=>[
                    'INDIVIDUEL'=>'INDIVIDUEL',
                    'GROUPE'=>'GROUPE'
                ],
                'attr'=>[
                    'class'=>'form-control'
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
            ->add('solde',TextType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}