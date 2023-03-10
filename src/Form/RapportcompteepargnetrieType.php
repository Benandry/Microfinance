<?php

namespace App\Form;

use App\Entity\Agence;
use App\Entity\Groupe;
use App\Entity\Individuelclient;
use App\Entity\ProduitEpargne;
use App\Repository\IndividuelclientRepository;
use App\Repository\ProduitEpargneRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportcompteepargnetrieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type',EntityType::class,[
                'class' => ProduitEpargne::class,
                'choice_label' => function($pr){
                    return $pr->getNomproduit()." ".$pr->getAbbreviation();
                },
                'placeholder' => " Type : ",
                'query_builder' => function(ProduitEpargneRepository $repo){
                    return $repo->createQueryBuilder('pr')
                            ->join('pr.ConfigProduit','config');
                },
                'attr' => [
                    'class' => "border-0"
                ],
                'autocomplete' => true,
                "required" => false,
            ])
            ->add('individuel',EntityType::class,[
                'class' => Individuelclient::class,
                'label' => 'individuel Client : ',
                'placeholder' => 'individuel Client ',
                'choice_label' => function($i) {
                    return $i->getNomClient()."  ".$i->getPrenomClient();
                },
                'query_builder' => function (IndividuelclientRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->andWhere("c.garant = 0 ");
                },
                'autocomplete' => true,
                'required' => false,
                'attr' => [
                    'class' => 'form-control border-0'
                ],
            ])
            ->add('groupe',EntityType::class,[
                'class' => Groupe::class,
                'label' => 'Groupe client : ',
                'placeholder' => 'Groupe client  ',
                'choice_label' => function($g) {
                    return $g->getCodegroupe()."  ".$g->getNomGroupe();
                },
                'autocomplete' => true,
                'required' => false,
                'attr' => [
                    'class' => 'form-control border-0'
                ],
            ])
            ->add('agence',EntityType::class,[
                'class' => Agence::class,
                'label' => 'Agence : ',
                'placeholder' => 'Agence ',
                'choice_label' => function($a) {
                    return $a->getNomAgence()."  ".$a->getCodeAgence();
                },
                'autocomplete' => true,
                'required' => false,
                'attr' => [
                    'class' => 'form-control border-0'
                ],
            ])

            ->add('date', DateType::class, [
                'label' => false,
                'required' => false,
                'widget' => 'single_text',
            ])

            ->add('debut', DateType::class, [
                'label' => false,
                'required' => false,
                'widget' => 'single_text',
            ])

            ->add('fin', DateType::class, [
                'label' => false,
                'required' => false,
                'widget' => 'single_text',
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
 