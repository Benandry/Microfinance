<?php

namespace App\Repository;

use App\Entity\RemboursementCredit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RemboursementCredit>
 *
 * @method RemboursementCredit|null find($id, $lockMode = null, $lockVersion = null)
 * @method RemboursementCredit|null findOneBy(array $criteria, array $orderBy = null)
 * @method RemboursementCredit[]    findAll()
 * @method RemboursementCredit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RemboursementCreditRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RemboursementCredit::class);
    }

    public function save(RemboursementCredit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RemboursementCredit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Api remboursement 
     *
     * @param integer $periode periode de remboursement credit
     * @return $query
     */
    public function ApiRemboursement($numerocredit)
    {
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT
            -- amortissement
                amortissement.periode,
                amortissement.dateRemborsement,
                amortissement.principale,
                amortissement.interet,
                amortissement.montanttTotal,
                amortissement.codeclient,
                amortissement.annuite,
                amortissement.penalite,
                amortissement.commission,
                amortissement.codecredit,
                amortissement.typeamortissement,
            -- remboursement
                remboursement.periode perioderemboursement,
                remboursement.MontantTotalPaye montantrembourse

            FROM
                App\Entity\AmortissementFixe amortissement
            LEFT JOIN
                App\Entity\RemboursementCredit remboursement
            WITH
                amortissement.periode = remboursement.periode
            WHERE
                amortissement.codecredit = :numerocredit
            ORDER BY remboursement.id DESC
                '
        )
        ->setParameter(':numerocredit',$numerocredit)
        ->setMaxResults(1)
        ;

        return $query->getResult();
    }


//    /**
//     * @return RemboursementCredit[] Returns an array of RemboursementCredit objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RemboursementCredit
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
