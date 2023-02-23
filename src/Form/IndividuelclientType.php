<?php

namespace App\Form;

use App\Entity\Agence;
use App\Entity\Commune;
use App\Entity\User;
use App\Entity\Etatcivile;
use App\Entity\Etude;
use App\Entity\Groupe;
use App\Entity\Individuelclient;
use App\Entity\Langue;
use App\Entity\Titre;
use App\Repository\GroupeRepository;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class IndividuelclientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('photo',FileType::class,[
                'mapped'=>false,
                'required'=>false,
            ])
            ->add('nom_client',TextType::class,[
                'row_attr'=>[
                    'class'=>'text-editor',
                    'class'=>'md-1',
                    'width'=>'5',
                ],
                'label'=>'Nom',
            ])
            ->add('prenom_client',TextType::class,[
                'label'=>'Prenom',
            ])
            ->add('nomConjoint',TextType::class,[
                'label'=>'Nom Conjoint',
            ])
            ->add('PrenomConjoint',TextType::class,[
                'label'=>'Prenom Conjoint'
            ])
            ->add('DateNaissanceConjoint',DateType::class,[
                'widget'=>'single_text'
            ])
            ->add('CINConjoint',TextType::class,[
                'label'=>'CIN Conjoint',
                'attr'=>[
                    'minlength'=>12,
                    'maxlength'=>12,
                ]
            ])
            ->add('ProfessionConjoint',TextType::class,[
                'label'=>'Profession Conjoint'
            ])
            ->add('date_inscription',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Date Inscription',
            ])
            ->add('sexe',ChoiceType::class,[
                'choices'=>[
                    'Masculin'=>'Masculin',
                    'Feminin'=>'Feminin',
                ],
                'attr'=>['class'=>'form-control']
            ])
            ->add('date_naissance',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Date de naissance',
            ])
            ->add('lieu_naissance')
            ->add('numeroMobile',TextType::class,[
                'label'=>'Numero telephone',
                'attr' => [
                    'class'=>'form-control',
                    'maxLength' =>10,
                    'minLength' =>10,
                ]
            ])
            ->add('profession')
            ->add('adressephysique',TextType::class,[
                'label'=>'Adresse physique',
            ])
            ->add('commune',EntityType::class,[
                'class'=>Commune::class,
                'placeholder'=>"Commune ...",
                'label'=>'Commune : ',
                'autocomplete' => true,
                'choice_label' => function ($c) {
                    return $c->getCodeCommune() . ' - ' . $c->getNomCommune();
                },
                'attr'=>['class'=>'form-control']
                ])
                ->add('Fokontany')
                ->add('District')
                ->add('Region')
                ->add('Longitude')
                ->add('Latitude')
            ->add('etatcivile',EntityType::class,[
                'class'=>Etatcivile::class,
                'choice_label'=>'etatcivile',
                'by_reference'=>true,
                'label'=>'Etat civile',
                'autocomplete' => true,
                'attr'=>['class'=>'form-control']
            ])
            ->add('etude',EntityType::class,[
                'class'=>Etude::class,
                'choice_label'=>'niveau',
                'by_reference'=>true,
                'mapped' => true,
                'autocomplete' => true,
            ])
            ->add('FormationProfessionnelle')
            ->add('Information')
            ->add('titre',EntityType::class,[
                'class'=>Titre::class,
                'choice_label'=>'titre',
                'by_reference'=>true,
                'mapped' => true,
                'attr'=>['class'=>'form-control']
            ])
            ->add('nb_enfant',IntegerType::class,[
                'label'=>'Nombre enfant',
            ])
            ->add('nb_personne_charge',IntegerType::class,[
                'label'=>'Nombre de personne en charge',
            ])
            ->add('parent_nom',TextType::class,[
                'label'=>'Nom parent',
            ])
            ->add('parent_adresse',TextType::class,[
                'label'=>'Parent adresse',
            ])
            ->add('PrenomParent')
            ->add('CINParent',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'maxLength' =>12,
                    'minLength' =>12,
                ]
            ])
            ->add('FokontanyParent')
            ->add('CommuneParent')
            ->add('DistrictParent')
            ->add('RegionParent')
            ->add('MembreGroupe',EntityType::class,[
                'class'=>Groupe::class,
                'choice_label'=>function($mg){
                    return $mg->getNomGroupe()." ".$mg->getCodegroupe();
                },
                // 'query_builder'=>function(GroupeRepository $mg){
                //     return $mg->createQueryBuilder('mg')
                //               ->where('mg.');
                // },
                'required'=>false,
                'by_reference'=>true,
                'mapped'=>true,
                'autocomplete' => true,
                'label'=>'Membre du groupe'
            ])
            ->add('TitreGroupe',ChoiceType::class,[
                'label'=>'Titre Groupe',
                'mapped'=>true,
                'required'=>false,
                'choices'=>[
                    ''=>'',
                    'President'=>'President',
                    'Secretaire'=>'Secretaire',
                    'Membre'=>'Membre'
                ],
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('dateadhesion',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Date d\'adhesion ',
                'required'=>false,
            ])

            // Information sur identite //
            ->add('TypeIdentite',ChoiceType::class,[
                'choices'=>[
                    'CIN'=>'CIN',
                    'Passeport'=>'Passeport'
                ],
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('cin',TextType::class,[
                'label'=>"Numéro d'identités : ",
                'attr'=>[
                    'class'=>'form-control',
                    'maxLength' =>12,
                    'minLength' =>12,
                ]
            ])
            ->add('datecin',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Date de delivrance : '
            ])
            ->add('lieudelivrance',TextType::class,[
                'label'=>'Lieu de delivrance :'
            ])
            ->add('dateexpiration',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Date expiration : '
            ])
            /// ******************************//

            ->add('codeclient',TextType::class,[
                'label' => 'Code clent',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('Agence',EntityType::class,[
                'class'=>Agence::class,
                'choice_label'=>'NomAgence',
                'autocomplete' => true,
                'placeholder' => 'Agence ...',
                'choice_label' => function ($c) {
                    return $c->getCodeAgence() . ' - ' . $c->getNomAgence();
                },
            ])

            ->add('user',EntityType::class,[
                'class'=>User::class,
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label' => "Agent ",
                'autocomplete' => true,
                'placeholder' => "Agent ...",
                'choice_label' => function ($c) {
                    return $c->getNom(). ' '.$c->getPrenom(); 
                }
            ])       
            ->add('garant') 
            ->add('Activite')
            ->add('SecteurActivite')
            ->add('LibelleMoyenProduction')
            ->add('MontantMoyenProduction')
            ->add('LibelleMoyenProduction2')
            ->add('MontantMoyenProduction2')
            ->add('LibelleMoyenProduction3')
            ->add('MontantMoyenProduction3')
            ->add('LibelleMoyenProduction4')
            ->add('MontantMoyenProduction4')
            ->add('EmployeTemporaire')
            ->add('CoutEmployeTemporaire')
            ->add('EmployePermanant')
            ->add('CoutEmployePermanent')
            
            ->add('ActiviteComplementaire')
            ->add('SecteurActvtComplmtr')
            ->add('LibellMoyenProdCmplmtr')
            ->add('MontantMoyenProdCmplmtr')
            ->add('LibellMoyenProdCmplmtr2')
            ->add('MontantMoyenProdCmplmtr2')
            ->add('LibellMoyenProdCmplmtr3')
            ->add('MontantMoyenProdCmplmtr3')
            ->add('LibellMoyenProdCmplmtr4')
            ->add('MontantMoyenProdCmplmtr4')
            ->add('EmployeTemprarCmplt')
            ->add('CoutEmployeTmprCmplmt')
            ->add('EmployePermntCmpltmt')
            ->add('CoutEmployePermntCmpltmt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Individuelclient::class,
        ]);
    }
}
