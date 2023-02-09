<?php

namespace App\Repository;

use App\Entity\PenaliteCredit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PenaliteCredit>
 *
 * @method PenaliteCredit|null find($id, $lockMode = null, $lockVersion = null)
 * @method PenaliteCredit|null findOneBy(array $criteria, array $orderBy = null)
 * @method PenaliteCredit[]    findAll()
 * @method PenaliteCredit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PenaliteCreditRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PenaliteCredit::class);
    }

    public function save(PenaliteCredit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PenaliteCredit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PenaliteCredit[] Returns an array of PenaliteCredit objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PenaliteCredit
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
