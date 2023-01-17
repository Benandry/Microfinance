<?php

namespace App\Repository;

use App\Entity\PlanComptableTier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlanComptableTier>
 *
 * @method PlanComptableTier|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanComptableTier|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanComptableTier[]    findAll()
 * @method PlanComptableTier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanComptableTierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanComptableTier::class);
    }

    public function save(PlanComptableTier $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PlanComptableTier $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PlanComptableTier[] Returns an array of PlanComptableTier objects
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

//    public function findOneBySomeField($value): ?PlanComptableTier
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
