<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
<<<<<<< HEAD
=======
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
>>>>>>> refs/remotes/origin/main
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RemboursementModalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
<<<<<<< HEAD
            ->add('codecredit',TextType::class)
            ->add('Suivant',SubmitType::class)
        ;
=======
            ->add('typeclient',ChoiceType::class,[
                'placeholder'=>'Type Client',
                'choices'=>[
                    'INDIVIDUEL'=>'INDIVIDUEL',
                    'GROUPE'=>'GROUPE',
                ]
            ])
            ->add('codecredit',TextType::class)
            ->add('penaliteprecedent',TextType::class,[
                    'required'=>false
            ])
            ->add('montantprecedent',TextType::class,[
                    'required'=>false
            ])
            ->add('montantdu',TextType::class,[
                'required'=>false
            ]) 
            ->add('periode',TextType::class,[
                'required'=>false
            ])
            ->add('restemontant',TextType::class,[
                'required'=>false
            ])
            ;
>>>>>>> refs/remotes/origin/main
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
