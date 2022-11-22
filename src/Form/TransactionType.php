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

class TransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Description',ChoiceType::class,[
                'choices'=>[
                    'DEPOT' =>'DEPOT'
                ],
                'attr'=>[
                    'class'=>'form-control',
                ]
            ])
            ->add('PieceComptable')
            ->add('typeClient',ChoiceType::class,[
                'choices'=>[
                    'INDIVIDUEL'=>'INDIVIDUEL',
                    'GROUPE'=>'GROUPE'
                ],
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('DateTransaction',DateType::class,[
                'widget'=>'single_text',
            ])
            ->add('Montant',IntegerType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'Montant'
                ])
                    ->add('montant_bruite',IntegerType::class,[
                    'label' => "Montant bruite",
                    'mapped' => false,
                    'attr'=>[
                        'class'=>'form-control'
                        ]
             ])
            ->add('papeterie',IntegerType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('commission',IntegerType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
            ])
            ->add('codeepargneclient',TextType::class,[
                'label'=>'Code client'
            ])
            ->add('nom',TextType::class,[
                'mapped'=>false,
                'attr'=>[
                    'class'=>'form-control',
                    'disabled'=>true,
                ]
                ])
                ->add('prenom',TextType::class,[
                    'mapped'=>false,
                    'attr'=>[
                        'class'=>'form-control',
                        'disabled'=>true,
                    ]
                ])
                ->add('nomgroupe',TextType::class,[
                    'mapped'=>false,
                    'attr'=>[
                        'class'=>'form-control',
                        'disabled'=>true,
                    ],
                    'label'=>'groupe'
                ])
                ->add('donneessolde',TextType::class,[
                    'mapped'=>false,
                    'attr'=>[
                        'class'=>'form-control',
                        'disabled'=>true,
                    ],
                    'label'=>'solde'
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