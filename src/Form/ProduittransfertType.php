<?php

namespace App\Form;

use App\Entity\CompteEpargne;
use App\Entity\Produittransfert;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduittransfertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datetransfert',DateType::class,[
                'widget'=>'single_text',
            ])
            ->add('montant')
            ->add('compte1',EntityType::class,[
                'class'=>CompteEpargne::class,
                'choice_label'=>'id',
                'by_reference'=>false,
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('compte2',EntityType::class,[
                'class'=>CompteEpargne::class,
                'choice_label'=>'id',
                'by_reference'=>false,
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produittransfert::class,
        ]);
    }
}
