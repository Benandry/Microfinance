<?php

namespace App\Form;

use App\Entity\CompteEpargne;
use App\Entity\TransfertProduit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransfertProduit1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datetransfert',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Date'
            ])
            ->add('Montant',IntegerType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('produitatransferer',EntityType::class,[
                'class'=>CompteEpargne::class,
                'choice_label'=>'codeepargne',
                'by_reference'=>false,
                'mapped'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'Produit à transferer'
            ])
            ->add('Produittransmis',EntityType::class,[
                'class'=>CompteEpargne::class,
                'choice_label'=>'id',
                'by_reference'=>false,
                'mapped'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'Produit transmit'
            ])
            ->add('compte',EntityType::class,[
                'class'=>CompteEpargne::class,
                'choice_label'=>'id',
                'by_reference'=>false,
                'mapped'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TransfertProduit::class,
        ]);
    }
}
