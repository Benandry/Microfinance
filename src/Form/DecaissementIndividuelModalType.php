<?php

namespace App\Form;

use App\Entity\ApprobationCredit;
use App\Entity\Individuelclient;
use App\Repository\IndividuelclientRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DecaissementIndividuelModalType extends AbstractType
{   
    /**
     * Undocumented function
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
        ->add('Client',EntityType::class,[
            'class'=>Individuelclient::class,
            'placeholder'=>'Choisir client',
            'choice_label'=>function($decaissement){
                return $decaissement->getNomClient().' '.$decaissement->getPrenomClient().'-'.$decaissement->getCodeClient();
            },
            'query_builder'=>function(IndividuelclientRepository $decaissement){
                return $decaissement->createQueryBuilder('i')
                ->innerJoin('App\Entity\DemandeCredit','d','WITH','i.codeclient=d.codeclient')
                ->innerJoin('App\Entity\ApprobationCredit','a','WITH','d.NumeroCredit=a.codecredit')
                ->leftJoin('App\Entity\Decaissement','dc','WITH','d.NumeroCredit=dc.numeroCredit')
                ->where('dc.numeroCredit IS NULL')
                        ->setMaxResults(5);
            },
            'autocomplete'=>true
        ]
        )
        ->add('nomclient')
        ->add('prenomclient')
        ->add('numerocredit')
        ->add('montantcredit')
        ->add('Date',DateType::class,[
            'widget'=>'single_text',
            ])
            
        ->add('Mode',ChoiceType::class,[
            'placeholder'=>'Mode de payement',
            'choices'=>[
                'ESPECES'=>'ESPECE',
                'DAV'=>'DAV',
            ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}