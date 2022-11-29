<?php

namespace App\Form;

use App\Entity\ConfigurationGeneralCredit;
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
            ->add('ProduitCredit')
            ->add('Devise')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ConfigurationGeneralCredit::class,
        ]);
    }
}
