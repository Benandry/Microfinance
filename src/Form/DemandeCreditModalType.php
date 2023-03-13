<?php

namespace App\Form;

use App\Entity\Groupe;
use App\Entity\Individuelclient;
use App\Repository\IndividuelclientRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeCreditModalType extends AbstractType
{
    /**
     * Undocumented function
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
        ->add('TypeClient',ChoiceType::class,[
            'placeholder'=>'Type Client',
            'choices'=>[
                'INDIVIDUEL'=>'INDIVIDUEL',
                'GROUPE'=>'GROUPE',
            ]
        ])
        ->add('CodeClient',EntityType::class,[
            'class'=>Individuelclient::class,
            'placeholder'=>'Nom Client',
            'choice_label'=>function($demande){
                return $demande->getNomClient().' '.$demande->getPrenomClient().'-'.$demande->getCodeClient();
            },
            'query_builder'=>function(IndividuelclientRepository $demande){
                return $demande->createQueryBuilder('i')
                        ->where('i.garant = false')
                        ->setMaxResults(5);
            },
            'autocomplete'=>true,
            'attr'=>[
                'class'=>'border-0'
            ],
            'required'=>false
        ])
        ->add('nom',TextType::class,[
            'required'=>false
        ])
        ->add('prenom',TextType::class,[
            'required'=>false
        ])
        ->add('codeclient',TextType::class,[
            'required'=>false
        ])
        ->add('codecreditindividuelprecedent',TextType::class,[
            'required'=>false,
        ])
        ->add('CodeGroupe',EntityType::class,[
            'class'=>Groupe::class,
            'placeholder'=>'Nom groupe',
            'choice_label'=>function($demande){
                return $demande->getNomGroupe().'-'.$demande->getCodegroupe();
            },
            'query_builder'=>function($demande){
                return $demande->createQueryBuilder('g')
                    ->setMaxResults(5);
            },
            'autocomplete'=>true,
            'attr'=>[
                'class'=>'border-0'
            ],
            'required'=>false
        ])
        ->add('nomgroupe',TextType::class,[
            'required'=>false
        ])
        ->add('codegroupe',TextType::class,[
            'required'=>false
        ]);

    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            // Configure your options
        ]);
    }

}