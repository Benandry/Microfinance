<?php

namespace App\Form;

use App\Entity\Agence;
use App\Entity\Commune;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
                'label' => 'Adresse agence :',
                'attr'=>[
                    'placeholder'=>'Adresse de l\'agence . . .',
                ]
            ])
            ->add('codeAgence')
            ->add('commune',EntityType::class,[
                'class' => Commune::class,
                'placeholder' => 'Commune ... ',
                'autocomplete' => true,
                'choice_label' => 'NomCommune'
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
