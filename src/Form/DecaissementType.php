<?php

namespace App\Form;

use App\Entity\Decaissement;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DecaissementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numeroCredit')
            ->add('montantCredit')
            ->add('dateDecaissement',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Date de decaissement : ',
                'mapped'=>true,
                'by_reference'=>true
                ])
            ->add('pieceComptable')
            ->add('fraisPapeterie')
            ->add('commissionCredit')
            ->add('fraisDeDeveloppement')
            ->add('caisseCredit')
            ->add('cash')
            ->add('cycleDeCredit')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Decaissement::class,
        ]);
    }
}
