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
                'required' => false,
                'choice_label'=>'nomGroupe',
                'autocomplete'=>true,
                'label'=> 'Groupe :',
                'placeholder'=> "Groupe ... "
                ])
            ->add('codeclient',EntityType::class,[
            'class'=>Individuelclient::class,
            'query_builder'=>function (EntityRepository $er){
                return $er->createQueryBuilder('i');
            },
            'choice_label'=>'nom_client',
            'label'=>'Individuel Client : ',
            'placeholder' => 'Client ...',
            'by_reference'=>true,
            'required' => false,
            'attr'=>[
                'class'=>'form-control'
            ],
            'autocomplete' => true,
            ])
            ->add('TypeClient',ChoiceType::class,[
                'choices'=>[
                    ' '=>' '
                ],
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
