<?php

namespace App\Form;

use App\Entity\DepotAterme;
use App\Entity\Individuelclient;
use App\Entity\ProduitEpargne;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepotAtermeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datedepot',DateType::class,[
                'widget'=>'single_text',
            ])
            ->add('piececomptable')
            ->add('tauxinteret')
            ->add('periodemois')
            ->add('is_interetcapitalise')
            ->add('date_echeance',DateType::class,[
                'widget'=>'single_text',
            ])
            ->add('valeurecheance')
            ->add('taxeretenue')
            ->add('retenuetaxe')
            ->add('TVA')
            ->add('is_depotcall')
            ->add('is_interetecheance')
            ->add('is_interetmois')
            ->add('is_interettrimestrielle')
            ->add('is_interetsemestrielle')
            ->add('is_interetpayelorscalcul')
            ->add('_is_interettransferercptep')
            ->add('is_retirealecheance')
            ->add('is_remetreaucptalecheance')
            ->add('compte',EntityType::class,[
                'class'=>Individuelclient::class,
                'choice_label'=>'nomclient',
                'by_reference'=>false,
            ])
            ->add('produit',EntityType::class,[
                'class'=>ProduitEpargne::class,
                'choice_label'=>'nomproduit',
                'by_reference'=>false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DepotAterme::class,
        ]);
    }
}
