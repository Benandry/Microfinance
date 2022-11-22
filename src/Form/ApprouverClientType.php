<?php

namespace App\Form;

use App\Entity\ApprouverClient;
use App\Entity\Individuelclient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApprouverClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateapprobation',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Date approbation'
            ])
            ->add('codeclient',EntityType::class,[
                'class'=>Individuelclient::class,
                'mapped'=>true,
                'choice_label'=>'id',
                'label'=>'Code client',
                'by_reference'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ],
            ])
            ->add('Valider',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ApprouverClient::class,
        ]);
    }
}
