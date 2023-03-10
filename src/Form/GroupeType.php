<?php

namespace App\Form;

use App\Entity\Commune;
use App\Entity\Groupe;
use App\Entity\Individuelclient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class GroupeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomGroupe',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                ]
            ])
            ->add('dateInscription',DateType::class, [
                'widget' => 'single_text',])
            ->add('numeroMobile',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'maxLength' => 10,
                    'minLength' => 10,
                ]
            ])
            ->add('email',EmailType::class,[
                'label' => 'adresse email du groupe : '
            ])
            ->add('codegroupe',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Groupe::class,
        ]);
    }
}
