<?php

namespace App\Form;

use App\Entity\Transfertep;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransfertepType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description_t',ChoiceType::class,[
                'attr'=>[
                    'class'=>'hidden'
                ],
                'choices'=>[
                    'TRANSFERT'=>'TRANSFERT'
                ],
                'label'=>false
            ])
            ->add('piece_comptable_t',TextType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('date_transaction_t',DateType::class,[
                    'widget'=>'single_text'
            ])
            ->add('montantdestinataire',IntegerType::class,[
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
                ]
            ])
            ->add('type_client_t',ChoiceType::class,[
                'choices'=>[
                    'INDIVIDUEL'=>'INDIVIDUEL',
                    'GROUPE'=>'GROUPE',
                ],
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('soldedestinataire',IntegerType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'disabled'=>false,
            ])
            ->add('soldeenvoyeur',IntegerType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'disabled'=>false,
            ])
            ->add('codetransaction_t',IntegerType::class,[
                'attr'=>[
                    'class'=>'hidden'
                ],
                'label'=>false,
                'required'=>false
            ])
            ->add('codedestinateur',TextType::class,[

                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=> 'Compte epargne destinateur'
            ])
            ->add('nomdestinatare',TextType::class,[
                'mapped'=>false,
                'disabled'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ],
                'required'=>false
            ])
            ->add('prenomdestinataire',TextType::class,[
                'mapped'=>false,
                'disabled'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ],
                'required'=>false
            ])
            ->add('codeenvoyeur',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'label' => 'Compte epargne Envoyeur'
                ],
                'required'=>false
            ])
            ->add('nomenvoyeur',TextType::class,[
                'mapped'=>false,
                'disabled'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('prenomenvoyeur',TextType::class,[
                'mapped'=>false,
                'disabled'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transfertep::class,
        ]);
    }
}