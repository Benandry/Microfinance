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
                'required'=>false,
            ])
            ->add('nom_client',TextType::class,[
                'row_attr'=>[
                    'class'=>'text-editor',
                    'class'=>'md-1',
                    'width'=>'5',
                ],
                'label'=>'Nom',
                'required'=>false,

            ])
            ->add('prenom_client',TextType::class,[
                'label'=>'Prenom',
            ])
            ->add('nomConjoint',TextType::class,[
                'label'=>'Nom Conjoint',
                'required'=>false,
            ])
            ->add('PrenomConjoint',TextType::class,[
                'label'=>'Prenom Conjoint',
                'required'=>false,
            ])
            ->add('DateNaissanceConjoint',DateType::class,[
                'widget'=>'single_text',
                'required'=>false,
            ])
            ->add('CINConjoint',TextType::class,[
                'label'=>'CIN Conjoint',
                'attr'=>[
                    'minlength'=>12,
                    'maxlength'=>12,
                ],
                'required'=>false,
            ])
            ->add('ProfessionConjoint',TextType::class,[
                'label'=>'Profession Conjoint',
                'required'=>false,
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
            ->add('lieu_naissance',TextType::class,[
                'required'=>false
            ])
            ->add('numeroMobile',TextType::class,[
                'label'=>'Numero telephone',
                'attr' => [
                    'class'=>'form-control',
                    'maxLength' =>10,
                    'minLength' =>10,
                ]
            ])
            ->add('profession',TextType::class,[
                'required'=>false
            ])
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
                ->add('Fokontany',TextType::class,[
                    'required'=>false
                ])
                ->add('District',TextType::class,[
                    'required'=>false
                ])
                ->add('Region',TextType::class,[
                    'required'=>false
                ])
                ->add('Longitude',TextType::class,[
                    'required'=>false
                ])
                ->add('Latitude',TextType::class,[
                    'required'=>false
                ])
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
            ->add('FormationProfessionnelle',TextType::class,[
                'label'=>'Formation Professionnelle',
                'required'=>false,
            ])
            ->add('Information',TextType::class,[
                'label'=>'Atelier',
                'required'=>false,
            ])
            ->add('titre',EntityType::class,[
                'class'=>Titre::class,
                'choice_label'=>'titre',
                'by_reference'=>true,
                'mapped' => true,
                'attr'=>['class'=>'form-control']
            ])
            ->add('nb_enfant',IntegerType::class,[
                'label'=>'Nombre enfant',
                'required'=>false,
            ])
            ->add('nb_personne_charge',IntegerType::class,[
                'label'=>'Nombre de personne en charge',
                'required'=>false,
            ])
            ->add('parent_nom',TextType::class,[
                'label'=>'Nom parent',
                'required'=>false,
            ])
            ->add('parent_adresse',TextType::class,[
                'label'=>'Parent adresse',
                'required'=>false,
            ])
            ->add('PrenomParent',TextType::class,[
                'label'=>'Prenom parent',
                'required'=>false,
            ])
            ->add('CINParent',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'maxLength' =>12,
                    'minLength' =>12,
                ],
                'required'=>false,
            ])
            ->add('FokontanyParent',TextType::class,[
                'label'=>'Fokontant Parent',
                'required'=>false,
            ])
            ->add('CommuneParent',TextType::class,[
                'label'=>'Commune Parent',
                'required'=>false,
            ])
            ->add('DistrictParent',TextType::class,[
                'label'=>'Disctrict parent',
                'required'=>false,
            ])
            ->add('RegionParent',TextType::class,[
                'label'=>'Region parent',
                'required'=>false,
            ])
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
                ],
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
            ->add('garant',CheckboxType::class,[
                'required'=>false
            ]) 
            ->add('Activite',TextType::class,[
                'required'=>false,
            ])
            ->add('SecteurActivite',TextType::class,[
                'label'=>'Secteur d\'activite',
                'required'=>false,
            ])
            ->add('LibelleMoyenProduction',TextType::class,[
                'label'=>'Libelle 1',
                'required'=>false,
            ])
            ->add('MontantMoyenProduction',IntegerType::class,[
                'label'=>'Valeur de production',
                'required'=>false,
            ])
            ->add('LibelleMoyenProduction2',TextType::class,[
                'label'=>'Libelle 2',
                'required'=>false,
            ])
            ->add('MontantMoyenProduction2',IntegerType::class,[
                'label'=>'Valeur de production 2',
                'required'=>false,
            ])
            ->add('LibelleMoyenProduction3',TextType::class,[
                'label'=>'Secteur d\'activite',
                'required'=>false,
            ])
            ->add('MontantMoyenProduction3',IntegerType::class,[
                'label'=>'Valeur de production 3',
                'required'=>false,
            ])
            ->add('LibelleMoyenProduction4',TextType::class,[
                'label'=>'Libelle 4',
                'required'=>false,
            ])
            ->add('MontantMoyenProduction4',IntegerType::class,[
                'label'=>'Valeur de production 4',
                'required'=>false,
            ])
            ->add('EmployeTemporaire',TextType::class,[
                'label'=>'Employe temporaire',
                'required'=>false,
            ])
            ->add('CoutEmployeTemporaire',IntegerType::class,[
                'label'=>'Cout employe temporaire',
                'required'=>false,
            ])
            ->add('EmployePermanant',TextType::class,[
                'label'=>'Employe permanant',
                'required'=>false,
            ])
            ->add('CoutEmployePermanent',IntegerType::class,[
                'label'=>'Cout employe permanant',
                'required'=>false,
            ])
            
            ->add('ActiviteComplementaire',TextType::class,[
                'label'=>'Activite complementaire',
                'required'=>false,
            ])
            ->add('SecteurActvtComplmtr',TextType::class,[
                'label'=>'Secteur d\'activite complementaire',
                'required'=>false,
            ])
            ->add('LibellMoyenProdCmplmtr',TextType::class,[
                'label'=>'Libelle moyen de production 1',
                'required'=>false,
            ])
            ->add('MontantMoyenProdCmplmtr',IntegerType::class,[
                'label'=>'Valeur de production 1',
                'required'=>false,
            ])
            ->add('LibellMoyenProdCmplmtr2',TextType::class,[
                'label'=>'Libelle moyen de production 2',
                'required'=>false,
            ])
            ->add('MontantMoyenProdCmplmtr2',IntegerType::class,[
                'label'=>'Valeur de production 2',
                'required'=>false,
            ])
            ->add('LibellMoyenProdCmplmtr3',TextType::class,[
                'label'=>'Libelle moyen de production 3',
                'required'=>false,
            ])
            ->add('MontantMoyenProdCmplmtr3',IntegerType::class,[
                'label'=>'Valeur de production 3',
                'required'=>false,
            ])
            ->add('LibellMoyenProdCmplmtr4',TextType::class,[
                'label'=>'Libelle moyen de production 4',
                'required'=>false,
            ])
            ->add('MontantMoyenProdCmplmtr4',IntegerType::class,[
                'label'=>'Valeur de production 4',
                'required'=>false,
            ])
            ->add('EmployeTemprarCmplt',TextType::class,[
                'label'=>'Employe temporaire',
                'required'=>false,
            ])
            ->add('CoutEmployeTmprCmplmt',IntegerType::class,[
                'label'=>'Cout Employe temporaire',
                'required'=>false,
            ])
            ->add('EmployePermntCmpltmt',TextType::class,[
                'label'=>'Employe permanant',
                'required'=>false,
            ])
            ->add('CoutEmployePermntCmpltmt',IntegerType::class,[
                'label'=>'Cout Employe permanant',
                'required'=>false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Individuelclient::class,
        ]);
    }
}
