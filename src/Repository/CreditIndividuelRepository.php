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
            configeneralcredit.ProduitLieEpargne,
            configeneralcredit.NombreJourInteretAnnee,
            configeneralcredit.NombreSemaineAnnee,
            configeneralcredit.ProduitLieEpargne,
            configeneralcredit.NombreJourInteretAnnee,
            configeneralcredit.NombreSemaineAnnee,
            configeneralcredit.RecalculDateEcheanceDecaissement,
            configeneralcredit.TauxInteretVariableSoldeDegressif,
            configeneralcredit.RecalculInteretRemboursementAmortissementDegressif,
            configeneralcredit.MethodeSoldeDegressifComposeCalculInteret,
            configeneralcredit.ExclurePrdtLimttionDmdeEtDecaissDeuxiemeCrdt,
            configeneralcredit.AutorisationDecaissementPartiellement,
            -- produit credit
            produitcredit.NomProduitCredit
            FROM
            App\Entity\CreditIndividuel creditindividuel
              INNER JOIN
            App\Entity\ConfigurationGeneralCredit configeneralcredit
              INNER JOIN
            App\Entity\ProduitCredit produitcredit
               WITH
            produitcredit.id = configeneralcredit.ProduitCredit
               AND
            produitcredit.id = creditindividuel.ProduitCredit
                WHERE
             creditindividuel.ProduitCredit= :produit
            '
        )
        ->setParameter(':produit',$produit);

        return $query->execute();
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
