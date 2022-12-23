<?php

namespace App\Form;

use App\Entity\ConfigurationGeneralCredit;
use App\Entity\ProduitCredit;
use App\Entity\Devise;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigurationGeneralCreditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ProduitLieEpargne')
            ->add('NombreJourInteretAnnee')
            ->add('NombreSemaineAnnee')
            ->add('RecalculDateEcheanceDecaissement')
            ->add('TauxInteretVariableSoldeDegressif')
            ->add('RecalculInteretRemboursementAmortissementDegressif')
            ->add('MethodeSoldeDegressifComposeCalculInteret')
            ->add('ExclurePrdtLimttionDmdeEtDecaissDeuxiemeCrdt')
            ->add('AutorisationDecaissementPartiellement')
            ->add('AcrivePrioriteRemboursementCredit')
            ->add('ProduitCredit',EntityType::class,[
                'class'=>ProduitCredit::class,
                'choice_label'=>'NomProduitCredit',
                'mapped'=>true,
                'by_reference'=>true,
                'placeholder'=>'Produit Credit'
            ])
            ->add('Devise',EntityType::class,[
                'class'=>Devise::class,
                'choice_label'=>'devise',
                'mapped'=>true,
                'by_reference'=>true,
                'placeholder'=>'Liste Devise'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ConfigurationGeneralCredit::class,
        ]);
    }
}
