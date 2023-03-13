<?php

namespace App\Repository;

use App\Entity\ConfigurationCredit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConfigurationCredit>
 *
 * @method ConfigurationCredit|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConfigurationCredit|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConfigurationCredit[]    findAll()
 * @method ConfigurationCredit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConfigurationCreditRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConfigurationCredit::class);
    }

    public function save(ConfigurationCredit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ConfigurationCredit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Undocumented function
     *
     * @method mixed ListeProduitConfigure():Liste des produits déjà configuré
     * @return void
     */
    public function ListeProduitConfigure()
    {
        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'SELECT
                produitcredit.NomProduitCredit,
                configcredit.id,
                configcredit.Montant,
                configcredit.MontantMin,
                configcredit.InteretNormal,
                configcredit.GarantieMoral,
                configcredit.GarantieMaterielle,
                configcredit.TauxGarantieMaterielle,
                configcredit.GarantieFinanciere,
                configcredit.TauxGarantieFinanciere,
                configcredit.FraisDossier,
                configcredit.FraisCommission,
                configcredit.FraisPapeterie,
                configcredit.PenaliteDiminutionIntrt,
                configcredit.PenalitePayementAntcp,
                configcredit.RetardPourcentage,
                configcredit.PayementAnticipe,
                configcredit.RetardForfaitaire,
                configcredit.RetardPeriode,
                configcredit.RetardPeriodeJour,
                configcredit.RetardPeriodeMois,
                configcredit.Methode,
                configcredit.Tranche
            FROM
                App\Entity\ConfigurationCredit configcredit
            INNER JOIN
                App\Entity\ProduitCredit produitcredit
            WITH
                configcredit.idProduit=produitcredit.id
            '
        );

        return $query->getResult();
    }

    /**
     *@method mixed ConfigurationCredit():Methode permet de lister tout les configurations credit
     * @param mixed $produitcredit:
     * @return void
     */
    public function ConfigurationCredit($produitcredit){
        
        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'SELECT
                configcredit.Montant,
                configcredit.MontantMin,
                configcredit.InteretNormal,
                configcredit.GarantieMoral,
                configcredit.GarantieMaterielle,
                configcredit.TauxGarantieMaterielle,
                configcredit.GarantieFinanciere,
                configcredit.TauxGarantieFinanciere,
                configcredit.FraisDossier,
                configcredit.FraisCommission,
                configcredit.FraisPapeterie,
                configcredit.PenaliteDiminutionIntrt,
                configcredit.PenalitePayementAntcp,
                configcredit.RetardPourcentage,
                configcredit.PayementAnticipe,
                configcredit.RetardForfaitaire,
                configcredit.RetardPeriode,
                configcredit.RetardPeriodeJour,
                configcredit.RetardPeriodeMois,
                configcredit.Methode,
                configcredit.Tranche
            FROM
                App\Entity\ConfigurationCredit configcredit
                INNER JOIN
                App\Entity\ProduitCredit produitcredit
                WITH
                configcredit.ProduitCredit=produitcredit.id
            WHERE
                configcredit.ProduitCredit = :produitcredit
            '
        )
        ->setParameter(':produitcredit',$produitcredit);

        return $query->getResult();
        
    }



//    /**
//     * @return ConfigurationCredit[] Returns an array of ConfigurationCredit objects
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

//    public function findOneBySomeField($value): ?ConfigurationCredit
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
