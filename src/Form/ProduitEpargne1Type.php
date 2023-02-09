<?php

namespace App\Form;

use App\Entity\ProduitEpargne;
use App\Entity\TypeEpargne;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitEpargne1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeEpargne',EntityType::class,[
                'class'=>TypeEpargne::class,
                'choice_label'=>'NomTypeEp',
                'mapped'=>true,
                'by_reference'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('nomproduit',TextType::class)
            ->add('isdesactive',CheckboxType::class,[
                'label'=>'Activer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProduitEpargne::class,
        ]);
    }
}
