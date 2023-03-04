<?php

namespace App\Form;

use App\Entity\CompteEpargne;
use App\Entity\Transfertep;
use App\Repository\CompteEpargneRepository;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransfertepType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description_t',ChoiceType::class,[
                'attr'=>[
                    'class'=>'hidden'
                ],
                'choices'=>[
                    'TRANSFERT'=>'TRANSFERT'
                ],
                'label'=>'Description'
            ])
            ->add('piece_comptable_t',TextType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label' => 'Piece comptable :'
            ])
            ->add('date_transaction_t',DateType::class,[
                    'widget'=>'single_text',
                    'label' => 'Date transaction :'
            ])
            ->add('montantdestinataire',IntegerType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label' => 'Montant a transfert :'
            ])
            ->add('type_client_t',ChoiceType::class,[
                'choices'=>[
                    'INDIVIDUEL'=>'INDIVIDUEL',
                    'GROUPE'=>'GROUPE',
                ],
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label' => 'Type client'
            ])
            ->add('soldedestinataire',IntegerType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label' => 'Solde de destinataire :'

            ])
            ->add('soldeenvoyeur',IntegerType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label' => 'Solde de envoyeur :'
            ])
            ->add('codetransaction_t',IntegerType::class,[
                'attr'=>[
                    'class'=>'hidden'
                ],
                'required'=>false,
                'label' => 'Code transaction:'
            ])
            ->add('codedestinateur',EntityType::class,[
                'class' => CompteEpargne ::class,
                'query_builder' => function (CompteEpargneRepository $repo){
                    return $repo->createQueryBuilder('c')
                    ->join('App\Entity\Transaction', 'tr', 'WITH', 'c.codeepargne = tr.codeepargneclient');
                },
                'choice_label' => function ($c) {
                    if ($c->getIndividuelclient()) {
                        // dd();
                        return $c->getCodeepargne()." -- ".$c->getIndividuelclient()->getNomClient()."  ".$c->getIndividuelclient()->getPrenomClient();
                    }
                    else {
                        return $c->getCodeepargne()." -- ".$c->getGroupe()->getNomGroupe()."  ".$c->getGroupe()->getEmail();
                    }
                },
                'attr'=>[
                    'class' => 'form-control border-0 custom-select-no-arrow',
                ],
                'placeholder' => "Compte epargne destinateur ",
                'autocomplete' => true,
                'label'=> 'Compte epargne destinateur'
            ])
            ->add('nomdestinatare',TextType::class,[
                'mapped'=>false,
                'attr'=>[
                    'class'=>'form-control'
                ],
                'required'=>false,
                'label' => 'Nom du destinataire :'
            ])
            ->add('prenomdestinataire',TextType::class,[
                'mapped'=>false,
                'attr'=>[
                    'class'=>'form-control'
                ],
                'required'=>false,
                'label' => 'Prenom du destinataire :'
            ])
            ->add('codeenvoyeur',EntityType::class,[
                'class' => CompteEpargne ::class,
                'query_builder' => function (CompteEpargneRepository $repo){
                    return $repo->createQueryBuilder('c')
                    ->join('App\Entity\Transaction', 'tr', 'WITH', 'c.codeepargne = tr.codeepargneclient');
                },
                'choice_label' => function ($c) {
                    if ($c->getIndividuelclient()) {
                        // dd();
                        return $c->getCodeepargne()." -- ".$c->getIndividuelclient()->getNomClient()."  ".$c->getIndividuelclient()->getPrenomClient();
                    }
                    else {
                        return $c->getCodeepargne()." -- ".$c->getGroupe()->getNomGroupe()."  ".$c->getGroupe()->getEmail();
                    }
                },
                'attr'=>[
                    'class' => 'form-control border-0 custom-select-no-arrow',
                ],
                'placeholder' => "Compte epargne Envoyeur ",
                'label' => 'Compte epargne envoyeur :',
                'autocomplete' => true,
            ])
            ->add('nomenvoyeur',TextType::class,[
                'mapped'=>false,
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label' => 'Nom envoyeur :'
            ])
            ->add('prenomenvoyeur',TextType::class,[
                'mapped'=>false,
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label' => 'Prenom envoyeur :'
            ])

            ->add('expediteur',TextType::class,[
                'mapped'=>false,
                'attr'=>[
                    'class'=>'form-control'
                ],
            ])

            ->add('receveur',TextType::class,[
                'mapped'=>false,
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transfertep::class,
        ]);
    }
}