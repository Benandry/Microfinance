<?php

namespace App\Form;

use App\Entity\ClientMobile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientMobileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Code_client')
            ->add('type_client')
            ->add('produit_epargne')
            ->add('actif')
            ->add('numero_mobile')
            ->add('code_pin')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ClientMobile::class,
        ]);
    }
}
