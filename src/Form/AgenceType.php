<?php

namespace App\Form;

use App\Entity\Agence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NomAgence',TextType::class,[
                'attr'=>[
                    'placeholder'=>'Nom de l\'agence . . . ',
                ]
            ])
            ->add('AdressAgence',TextType::class,[
                'attr'=>[
                    'placeholder'=>'Adresse de l\'agence . . .',
                ]
            ])
            ->add('commune',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                ]
            ])
            ->add('Save',SubmitType::class,[
                'label'=>'Sauvegarder',
                'attr'=>[
                    'class'=>'btn btn-primary btn-sm',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agence::class,
        ]);
    }
}
