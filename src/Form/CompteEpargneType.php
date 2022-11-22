<?php

namespace App\Form;

use App\Entity\CompteEpargne;
use App\Entity\Groupe;
use App\Entity\Individuelclient;
use App\Entity\ProduitEpargne;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompteEpargneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datedebut',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Date',
                'attr'=>[
                    'class'=>'form-control'
                ],
            ])
            ->add('typeClient',ChoiceType::class,[
                'choices'=>[
                    'INDIVIDUEL'=>'INDIVIDUEL',
                    'GROUPE'=>'GROUPE',
                ],
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('produit',EntityType::class,[
                'class'=>ProduitEpargne::class,
                'mapped'=>true,
                'choice_label'=>'nomproduit',
                'placeholder' =>'Choisir un produit ',
                'by_reference'=>true,
                'label'=>'Nom Produit',
                'attr'=>[
                    'class'=>'form-control'
                ]
                ])

            ->add('codeep',TextType::class,[
                'mapped'=>true,
                'label'=>'Code client',
                'attr'=>[
                    'class'=>'form-control'
                ],
                
            ])

            ->add('nom',TextType::class,[
                'mapped'=>false,
                'disabled' => true,
                'label'=>'Nom client',
                'attr'=>[
                    'class'=>'form-control'
                ],
                
            ])

            ->add('prenom',TextType::class,[
                'mapped'=>false,
                'disabled' => true,
                'label'=>'prenom client',
                'attr'=>[
                    'class'=>'form-control'
                ],
                
            ])

            ->add('codeepargne',TextType::class,[
                'attr'=>[
                    'class'=>'hidden',
                ],
                'label'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CompteEpargne::class,
        ]);
    }
}
