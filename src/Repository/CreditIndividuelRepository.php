<?php

namespace App\Repository;

use App\Entity\CreditIndividuel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CreditIndividuel>
 *
 * @method CreditIndividuel|null find($id, $lockMode = null, $lockVersion = null)
 * @method CreditIndividuel|null findOneBy(array $criteria, array $orderBy = null)
 * @method CreditIndividuel[]    findAll()
 * @method CreditIndividuel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreditIndividuelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CreditIndividuel::class);
    }

    public function add(CreditIndividuel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CreditIndividuel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // Cette fonction permet de recuperer les informations sur les configuration credit
    public function api_configuration($produit){

        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT
            -- credit individuel
            creditindividuel.TauxInteretAnnuel,
            creditindividuel.DifferementPayement,
            creditindividuel.Tranche,
            creditindividuel.TypeTranche,
            creditindividuel.CalculInteret,
            creditindividuel.MontantMaximumCredit,
            creditindividuel.MontantMinimumCredit,
            creditindividuel.DelaisDeGraceMaxi,
            creditindividuel.PaiementPrealableInteret,
            creditindividuel.CalculIntertPourDiffere,
            creditindividuel.IntaretDifferePaiementCapitalise,
            creditindividuel.InteretPayerDiffere,
            creditindividuel.TrancheDistinctInteret,
            creditindividuel.InteretDeductDecaissement,
            creditindividuel.CalculInteretJours,
            creditindividuel.ForfaitPaiementPrealableInteret,
            creditindividuel.PeriodeMinimumCredit,
            creditindividuel.PeriodeMaximumCredit,
            -- configuration general
            -- configeneralcredit.ProduitLieEpargne,
            configeneralcredit.NombreJourInteretAnnee,
            configeneralcredit.NombreSemaineAnnee,
            -- configeneralcredit.ProduitLieEpargne,
            configeneralcredit.NombreJourInteretAnnee,
            configeneralcredit.NombreSemaineAnnee,
            configeneralcredit.RecalculDateEcheanceDecaissement,
            configeneralcredit.TauxInteretVariableSoldeDegressif,
            configeneralcredit.RecalculInteretRemboursementAmortissementDegressif,
            configeneralcredit.MethodeSoldeDegressifComposeCalculInteret,
            configeneralcredit.ExclurePrdtLimttionDmdeEtDecaissDeuxiemeCrdt,
            configeneralcredit.AutorisationDecaissementPartiellement,
            -- configuration frais
            frais.TypeClient,
            frais.Papeterie,
            frais.Commission,
            frais.FraisDeDeveloppement,
            frais.FraisDeRefinancement,
            frais.CommissionCreditChaqueTrancheInd,
            frais.DroitTimbreSurCapital,
            frais.SurInteretCours,
            -- configuration garantie credit
            garantie.CreditBaseEpargne,
            garantie.MontantCreditDmdIndividuel,
            garantie.MontantCreditDmdGroupe,
            garantie.MontantCrdAnciensCreditenCours,
            garantie.MontantCrdAnciensCreditenCoursGrp,
            garantie.GarantieBaseMontantCredit,
            garantie.DeduireGarantieAuDecaissement,
            garantie.DeduireGarantieAuDecaissementGrp,
            garantie.GarantieObligatoireCreditInd,
            garantie.MontantExige,
            garantie.regle,
            garantie.MontantGarant,
            garantie.GarantObligatoireCreditGrp,
            garantie.MontantGarantieGrp,
            garantie.reglegrp,
            -- compe GL1
            comptegl.CptePrncplEnCours,
            comptegl.CpteProvisionMvsCreances,
            comptegl.CpteProvsionCoutMvsCreance,
            comptegl.CptIntrtRecuCrdt,
            comptegl.CpteCrdtPassePerte,
            comptegl.CpteInteretEchus,
            comptegl.CpteIntrtEchusRecvoir,
            comptegl.CpteRefinancmntCrdt,
            comptegl.CptePnltsComptblsAvnce,
            comptegl.CpteRvnuePnltsComptblsAvnce,
            comptegl.CpteCommssionAccmlGagne,
            comptegl.CpteRcvrmtCrncsDouteuse,
            comptegl.CptePapeterie,
            comptegl.CpteCheque,
            comptegl.CpteSurpaiement,
            comptegl.CpteChrgCheque,
            comptegl.CpteCommssionCrdt,
            comptegl.CptePnltsCrdt,
            comptegl.DiffrnceMonnaie,
            comptegl.PapeterieDemande,
            comptegl.CommissionDemande,
            comptegl.FraisDeveloppementDmd,
            comptegl.FraisRefinancementDemande,
            comptegl.PapeterieDecaissement,
            comptegl.CommissionDecaissement,
            comptegl.MajorationDecaissement,
            comptegl.FraisDeveloppementDecssmnt,
            comptegl.FraisTrtementDecaissement
            -- plan comptable
            FROM
            App\Entity\CreditIndividuel creditindividuel
              INNER JOIN
            App\Entity\ConfigurationGeneralCredit configeneralcredit
              INNER JOIN
            App\Entity\ProduitCredit produitcredit
                INNER JOIN
            App\Entity\FraisConfigCredit frais
                INNER JOIN
            App\Entity\GarantieCredit garantie
                INNER JOIN
            App\Entity\CompteGL1 comptegl
               WITH
            produitcredit.id = configeneralcredit.ProduitCredit
               AND
            produitcredit.id = creditindividuel.ProduitCredit
                AND
            produitcredit.id = frais.ProduitCredit
                AND
            garantie.ProduitCredit = produitcredit.id
                AND
            comptegl.ProduitCredit = produitcredit.id
                WHERE
             creditindividuel.ProduitCredit= :produit
            '
        )
        ->setParameter(':produit',$produit);

        return $query->execute();
    }

    // API pour les clients
    public function api_client_individuel($codeclient){
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
        'SELECT DISTINCT
            -- individuel
            individuel.nom_client nom,
            individuel.codeclient codeindividuel,
            -- compte epargne
            compteepargne.codeepargne codeepargne,
            -- -- transaction
            -- max(transaction.id),
            SUM(transaction.Montant) soldeepargne,
            -- -- produit epargne
            produitepargne.nomproduit,
            -- -- type produit
            typeepargne.NomTypeEp
         FROM
            -- individuel et compte epargne
         App\Entity\IndividuelClient individuel
        LEFT JOIN
             App\Entity\CompteEpargne compteepargne
        WITH
             compteepargne.codeep = individuel.codeclient

            --produit epargne
        LEFT JOIN
             App\Entity\ProduitEpargne produitepargne
        WITH
         produitepargne.id=compteepargne.produit
            -- type epargne
         LEFT JOIN
         App\Entity\TypeEpargne typeepargne
            WITH
            produitepargne.typeEpargne =  typeepargne.id
            AND typeepargne.NomTypeEp =\'Depot de garantie\'
        LEFT JOIN
         App\Entity\Transaction transaction
            WITH
            transaction.codeepargneclient = compteepargne.codeepargne
         WHERE individuel.codeclient =:codeclient
          ')
         ->setParameter(':codeclient',$codeclient);

        return $query->getResult();
    }

    // Cette fonction permet d'indentifier le client deja emprunté
    public function api_demandecredit($codeclient){

        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT
                demande.codeclient
            FROM
                App\Entity\DemandeCredit demande
            WHERE
            demande.codeclient = :codeclient
            ')
            ->setParameter(':codeclient',$codeclient);

        return $query->getResult();
    }

//    /**
//     * @return CreditIndividuel[] Returns an array of CreditIndividuel objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CreditIndividuel
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
