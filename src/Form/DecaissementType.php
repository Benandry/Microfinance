<?php

namespace App\Form;

use App\Entity\Analytique;
use App\Entity\CompteEpargne;
use App\Entity\Decaissement;
use App\Entity\PlanComptable;
use App\Entity\User;
use App\Repository\CompteEpargneRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DecaissementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numeroCredit')
            ->add('montantCredit')
            ->add('dateDecaissement',DateType::class,[
                'widget'=>'single_text',
                'label'=>'Date de decaissement : ',
                'mapped'=>true,
                'by_reference'=>true
                ])
            ->add('pieceComptable')
            ->add('commissionCredit')
            ->add('fraisDeDeveloppement')
            ->add('OrigineFond')
            ->add('Filiere')
            ->add('ChaineValeur')
            ->add('idepargne',EntityType::class,[
                'class'=>CompteEpargne::class,
                'placeholder'=>'Choisir un compte',
                'choice_label'=>function ($DAV){
                    return $DAV->getCodeepargne();
                },
                'query_builder'=>function(CompteEpargneRepository $DAV){
                    return $DAV->createQueryBuilder('c')
                        ->join('c.produit','p')
                        ->where('c.produit = p.id')
                        ->andWhere('p.nomproduit = \'Dépôts de garantie\'')
                    ;
                },
                'autocomplete'=>true,
                'label'=>'Depot de garantie',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('NumeroCompteEpargne',TextType::class,[
                'required'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Decaissement::class,
        ]);
    }
}
