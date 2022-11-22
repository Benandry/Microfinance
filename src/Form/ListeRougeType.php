<?php

namespace App\Form;

use App\Entity\Groupe;
use App\Entity\Individuelclient;
use App\Entity\ListeRouge;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListeRougeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateliste',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Date'
            ])
            ->add('raison',TextType::class,[
                'label'=>'Raison',
            ])
            ->add('codegroupe',EntityType::class,[
                'class'=>Groupe::class,
                'choice_label'=>'nomGroupe',
                'by_reference'=>true,
                'attr'=>[
                    'class'=>'hidden'
                ],
                'label'=>false,
                'mapped'=>false
                ])
            ->add('codeclient',EntityType::class,[
            'class'=>Individuelclient::class,
            'query_builder'=>function (EntityRepository $er){
                return $er->createQueryBuilder('i');
            },
            'choice_label'=>'nom_client',
            'label'=>'Code Client',
            'by_reference'=>true,
            'attr'=>[
                'class'=>'form-control'
            ]
            ])
            ->add('TypeClient',ChoiceType::class,[
                'choices'=>[
                    'INDIVIDUEL'=>'INDIVIDUEL'
                ],
                'attr'=>[
                    'class'=>'hidden'
                ],
                'label'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ListeRouge::class,
        ]);
    }
}
