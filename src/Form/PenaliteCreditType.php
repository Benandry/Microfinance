<?php

namespace App\Form;

use App\Entity\PenaliteCredit;
use App\Entity\ProduitCredit;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Config\Definition\FloatNode;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PenaliteCreditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('CalculMntntFixParOccasion',RadioType::class,[
                'label'=>'Calcul Montant Fixe par Occasion'
            ])
            ->add('PnlitePourcntgDurntunPeriod',RadioType::class,[
                'label'=>'Penalite Pourcentage Durant une periode'
            ])
            ->add('ClculCommPourctngSimple',RadioType::class,[
                'label'=>'Calcul comme pourcentage simple'
            ])
            ->add('CalculSlnNbrSemne',RadioType::class,[
                'label'=>'Calcul selon le nombre de semaine'
            ])
            ->add('CalculSmplPrctgSoldImpaye',RadioType::class,[
                'label'=>'Calcul Simple pourcentage du solde impaye'
            ])
            ->add('CalculSurArrierePrcpl',RadioType::class,[
                'label'=>'Caclul sur arriere principale'
            ])
            ->add('SurArrierPrcplIntrt',RadioType::class,[
                'label'=>'Sur arriere principale interet'
            ])
            ->add('SurPrcplIntrtPnltArriere',RadioType::class,[
                'label'=>'Sur principale interet penalite arriere'
            ])
            ->add('PenalitMinimum',TextType::class,[
                'label'=>'Avec un minimum de'
            ])
            ->add('PenalitMaximum',TextType::class,[
                'label'=>'Penalites devrais etre calculées pour un max de'
            ])
            ->add('CalculAutoPenalite',RadioType::class,[
                'label'=>'Calcul Auto Penalite'
            ])
            ->add('CalculPenaliteAlaConnection',RadioType::class,[
                'label'=>'Calcul penalite a la connection'
            ])
            ->add('ClclPnltSrIntrtCptlsEtPnltArr',RadioType::class,[
                'label'=>'Calcul penalite sur interet capitalise et penalite arriere'
            ])
            ->add('ClclPnltSiJrArrierDpassDlGrass',RadioType::class,[
                'label'=>'Calcul penalite si jour arriere depasse le delai de grasse'
            ])
            ->add('TrnsferAutoFondCptEprgnAuxCptCrdt',RadioType::class,[
                'label'=>'Transfert auto des fonds des comptes epargne aux compte credit'
            ])
            ->add('UtilseSoldeMin',RadioType::class,[
                'label'=>'Utilise solde minimum'
            ])
            ->add('JourMinimumArriere',TextType::class,[
                'label'=>'Jour minimum Arriere'
            ])
            ->add('PnltClclCmmMntnFixPrJr',RadioType::class,[
                'label'=>'Penalite calculer comme montant fixe par jour'
            ])
            ->add('PnltBsSrMntntDuPrTrnches',RadioType::class,[
                'label'=>'Penalite base sur montants dus par tranches'
            ])
            ->add('PnltPrChqTrnchRtrd',RadioType::class,[
                'label'=>'Penalite pour chaque tranche en retard'
            ])
            ->add('PnltJourFerierEtWE',RadioType::class,[
                'label'=>'Penalite aux jours ferie week end'
            ])
            ->add('PenaliteComme',TextType::class,[
                'label'=>'Penalite Comme %',
            ])
            ->add('DiffePaimntEnNbrJrAvntPnltImps',TextType::class,[
                'label'=>'Differé de paiement en nombre de jours avant que les pénalités soient imposés %',
            ])
            ->add('InclrCrdtAvcMntntDusAuJrRapprt',RadioType::class,[
                'label'=>'Inclure credit avec montants dus au jour de rapport'
            ])
            ->add('ProduitCredit',EntityType::class,[
                'class'=>ProduitCredit::class,
                'placeholder'=>'Choisir Produit Credit',
                'choice_label'=>'NomProduitCredit'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PenaliteCredit::class,
        ]);
    }
}
