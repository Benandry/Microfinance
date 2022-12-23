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

    public function add(RemboursementCredit $entity, bool $flush = false): void
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
