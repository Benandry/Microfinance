<?php

namespace App\Form;

use App\Entity\CompteEpargne;
use App\Entity\Groupe;
use App\Entity\Individuelclient;
use App\Entity\ProduitEpargne;
use App\Repository\ProduitEpargneRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompteGroupeEpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datedebut',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Date inscription',
            ])
            ->add('typeClient',ChoiceType::class,[
                'choices'=>[
                    'GROUPE'=>'GROUPE',
                ],
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])

           ->add('typeAfficher',ChoiceType::class,[
                'label' => "Type client : ",
                'choices'=>[
                    'GROUPE'=>'GROUPE',
                ],
                'disabled' => true,
                'mapped' => false
            ])
            ->add('produit',EntityType::class,[
                'class'=>ProduitEpargne::class,
                'choice_label'=> function ($c){
                    return $c->getNomproduit()." (".$c->getAbbreviation().")";
                },
                'query_builder' => function (ProduitEpargneRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->andWhere("p.isdesactive = 1 ");
                },
                'placeholder' =>'Choisissez un produit ',
                'autocomplete'=>true,
                'label'=>'Nom Produit',
            ])
            ->add('codeep',TextType::class,[
                'mapped'=>true,
                'label'=>'Code client',
                'attr'=>[
                    'class'=>'form-control'
                ],
                
            ])
            ->add('codeepargne',TextType::class,[
                'attr'=>[
                    'class'=>'hidden',
                ],
                'label'=>false
            ])
            
            ->add('Valider',SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-primary'
                ],
                'label' => "Créer compte"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CompteEpargne::class,
        ]);
    }
}
