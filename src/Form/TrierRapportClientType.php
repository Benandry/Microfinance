<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrierRapportClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('search_one_date',DateType::class,[
                'widget'=>'single_text',
                'format' => 'yyyy-MM-dd',
                'label'=>' ',
                'mapped'=>true,
                'html5'=>true,
                'required' => false
            ])
            ->add('date1',DateType::class,[
                'widget'=>'single_text',
                'format' => 'yyyy-MM-dd',
                'label'=>'Du',
                'mapped'=>true,
                'html5'=>true,
                'required' => false
            ])

            ->add('date2',DateType::class,[
                'widget'=>'single_text',
                'format' => 'yyyy-MM-dd',
                'label'=>'Au',
                'mapped'=>true,
                'html5'=>true,
                'required' => false
            ])
            
            ->add('agent',EntityType::class,[
                'class' => User::class,
                'choice_label' => function ($c){
                    return $c->getNom().' '.$c->getPrenom();
                },
                'autocomplete' => true,
                'required' => false,
                'label' => false,
            ])

            

            ->add('Chercher',SubmitType::class,[
                'attr'=>[
                    'class'=>'btn btn-primary btn-sm'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
