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
                'label'=>'Description'
            ])
            ->add('piece_comptable_t',TextType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label' => 'Piece comptable :'
            ])
            ->add('date_transaction_t',DateType::class,[
                    'widget'=>'single_text',
                    'label' => 'Date transaction :'
            ])
            ->add('montantdestinataire',IntegerType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label' => 'Montant a transfert :'
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
                ],
                'label' => 'Type client'
            ])
            ->add('soldedestinataire',IntegerType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label' => 'Solde de destinataire :'

            ])
            ->add('soldeenvoyeur',IntegerType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label' => 'Solde de envoyeur :'
            ])
            ->add('codetransaction_t',IntegerType::class,[
                'attr'=>[
                    'class'=>'hidden'
                ],
                'required'=>false,
                'label' => 'Code transaction:'
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
                'required'=>false,
                'label' => 'Nom du destinataire :'
            ])
            ->add('prenomdestinataire',TextType::class,[
                'mapped'=>false,
                'disabled'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ],
                'required'=>false,
                'label' => 'Prenom du destinataire :'
            ])
            ->add('codeenvoyeur',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'label' => 'Compte epargne Envoyeur'
                ],
                'required'=>false,
                'label' => 'Code envoyeur :'
            ])
            ->add('nomenvoyeur',TextType::class,[
                'mapped'=>false,
                'disabled'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label' => 'Nom envoyeur :'
            ])
            ->add('prenomenvoyeur',TextType::class,[
                'mapped'=>false,
                'disabled'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label' => 'Prenom envoyeur :'
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