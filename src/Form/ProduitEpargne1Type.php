<?php

namespace App\Form;

use App\Entity\ProduitEpargne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitEpargne1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomproduit',TextType::class,[
                'label' => "Produit epargne : "
            ])
            ->add('abbreviation',TextType::class,[
                'label' => "Abreviation du produit : ",
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProduitEpargne::class,
        ]);
    }
}
