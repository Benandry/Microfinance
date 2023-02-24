<?php

namespace App\Form;

use App\Entity\CompteEpargne;
use App\Entity\ProduitEpargne;
use App\Repository\ProduitEpargneRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompteEpargneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datedebut',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Date',
                'attr'=>[
                    'class'=>'form-control'
                ],
            ])
            ->add('typeClient',ChoiceType::class,[
                'choices'=>[
                    'INDIVIDUEL'=>'INDIVIDUEL',
                ],
            ])
            ->add('typeAfficher',ChoiceType::class,[
                'label' => "Type client : ",
                'choices'=>[
                    'INDIVIDUEL'=>'INDIVIDUEL',
                ],
                'disabled' => true,
                'mapped' => false
            ])
            ->add('produit',EntityType::class,[
                'class'=>ProduitEpargne::class,
                'attr'=>[
                    'class' => 'form-control border-0 custom-select-no-arrow',
                ],
                'choice_label'=> function ($c){
                    return $c->getNomproduit()." (".$c->getAbbreviation().")";
                },
                'query_builder' => function (ProduitEpargneRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->join('p.ConfigProduit','config')
                        ->andWhere("config.statusProduit = 1 ");
                },
                'placeholder' =>'Choisissez un produit ',
                'autocomplete'=> true,
                'label'=>'Nom Produit',
                ])

            ->add('codeep')
            ->add('nom',TextType::class,[
                'mapped'=>false,
                'disabled' => true,
                'label'=>'Nom client',
                'attr'=>[
                    'class'=>'form-control'
                ],
                
            ])

            ->add('prenom',TextType::class,[
                'mapped'=>false,
                'disabled' => true,
                'label'=>'prenom client',
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CompteEpargne::class,
        ]);
    }
}
