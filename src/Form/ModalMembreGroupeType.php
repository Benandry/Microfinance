<?php

namespace App\Form;

use App\Entity\Individuelclient;
use App\Repository\IndividuelclientRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModalMembreGroupeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',EntityType::class,[
                'class'=>Individuelclient::class,
                'placeholder'=>'Nom Client',
                'choice_label'=>function($g){
                    return $g->getNomClient().' '.$g->getPrenomClient().'-'.$g->getCodeclient();
                },
                'query_builder'=>function(IndividuelclientRepository $g){
                    return $g->createQueryBuilder('i')
                            ->where('i.garant = false')
                            ->where('i.TitreGroupe = \' \'')
                            ->setMaxResults(5);
                },
                'autocomplete'=>true,
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
