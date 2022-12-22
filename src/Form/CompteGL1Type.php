<?php

namespace App\Form;

use App\Entity\CompteGL1;
use App\Entity\ProduitCredit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompteGL1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ProduitCredit',EntityType::class,[
                'class'=>ProduitCredit::class,
                'choice_label'=>'NomProduitCredit',
                'mapped'=>true,
                'by_reference'=>true,
                'placeholder'=>'Choisir un produit credit'
            ])
            ->add('CptePrncplEnCours')
            ->add('CpteProvisionMvsCreances')
            ->add('CpteProvsionCoutMvsCreance')
            ->add('CptIntrtRecuCrdt')
            ->add('CpteCrdtPassePerte')
            ->add('CpteInteretEchus')
            ->add('CpteIntrtEchusRecvoir')
            ->add('CpteRefinancmntCrdt')
            ->add('CptePnltsComptblsAvnce')
            ->add('CpteRvnuePnltsComptblsAvnce')
            ->add('CpteCommssionAccmlGagne')
            ->add('CpteRcvrmtCrncsDouteuse')
            ->add('CptePapeterie')
            ->add('CpteCheque')
            ->add('CpteSurpaiement')
            ->add('CpteChrgCheque')
            ->add('CpteCommssionCrdt')
            ->add('CptePnltsCrdt')
            ->add('DiffrnceMonnaie')
            ->add('PapeterieDemande')
            ->add('CommissionDemande')
            ->add('FraisDeveloppementDmd')
            ->add('FraisRefinancementDemande')
            ->add('PapeterieDecaissement')
            ->add('CommissionDecaissement')
            ->add('MajorationDecaissement')
            ->add('FraisDeveloppementDecssmnt')
            ->add('FraisTrtementDecaissement')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CompteGL1::class,
        ]);
    }
}
