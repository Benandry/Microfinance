<?php

namespace App\Form;

use App\Entity\CategorieCredit;
use App\Entity\DemandeCredit;
use App\Entity\FondCredit;
use App\Entity\Individuelclient;
use App\Entity\ProduitCredit;
use App\Entity\ProduitEpargne;
use App\Entity\User;
use App\Repository\IndividuelclientRepository;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeCreditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codeclient',TextType::class,[
                'attr' => [
                    'class'=>'form-control',
                    'maxLength' =>10,
                    'minLength' =>10,
                ]
            ])
            ->add('TypeClient',TextType::class)
            ->add('NumeroCredit')
            ->add('DateDemande',DateType::class,[
                'widget'=>'single_text'
            ])
            ->add('Montant')
            ->add('TauxInteretAnnuel')
            ->add('NombreTranche')
            ->add('TypeTranche')
            ->add('SoldeEpargne',TextType::class,[
                'label' => " Solde Epargne :",
                'required'=>false,
            ])
            ->add('agent',EntityType::class,[
                    'class' => User::class,
                    'choice_label' => "prenom",
                    'label' => "Agent de credit :",
                    'placeholder' => "agent de credit",
                    'autocomplete' => true,
                    'required'=>true
            ])
            ->add('ProduitCredit',EntityType::class,[
                'class'=>ProduitCredit::class,
                'choice_label'=>'NomProduitCredit',
                'by_reference'=>true,
                'placeholder'=>'Choisir Produit Credit'
            ])
            
            ->add('garant',EntityType::class,[
                'class'=>Individuelclient::class,
                'placeholder'=>'Choisir garant',
                'choice_label'=>function($garant){
                    return $garant->getNomClient().' '.$garant->getPrenomClient().'-'.$garant->getCodeClient();
                },
                'query_builder'=>function(IndividuelclientRepository $garant){
                    return $garant->createQueryBuilder('i')
                                  ->where('i.garant = true')
                                  ->setMaxResults(5);
                },
                'autocomplete'=>true
            ])
            ->add('cycles')
            ->add('CompteEpargne')
            // On recupere les donnees pour les patrimoines ici
            ->add('codecreditprecedent',TextType::class,[
                'mapped'=>false,
                'required'=>false
            ])
            ->add('Libelle1',TextType::class,[
                'label'=>'Libelle 1',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('Montant0',NumberType::class,[
                'label'=>'Montant 1',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('Libelle2',TextType::class,[
                'label'=>'Libelle 2',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('Montant2',NumberType::class,[
                'label'=>'Montant 2',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('Libelle3',TextType::class,[
                'label'=>'Libelle 3',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('Montant3',NumberType::class,[
                'label'=>'Montant 3',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('Libelle4',TextType::class,[
                'label'=>'Libelle 4',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('Montant4',NumberType::class,[
                'label'=>'Montant 4',
                'mapped'=>false,
                'required'=>false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DemandeCredit::class,
        ]);
    }
}
