<?php

namespace App\Repository;

use App\Entity\ReechelonnementCredit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReechelonnementCredit>
 *
 * @method ReechelonnementCredit|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReechelonnementCredit|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReechelonnementCredit[]    findAll()
 * @method ReechelonnementCredit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReechelonnementCreditRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReechelonnementCredit::class);
    }

    public function save(ReechelonnementCredit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ReechelonnementCredit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ReechelonnementCredit[] Returns an array of ReechelonnementCredit objects
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

//    public function findOneBySomeField($value): ?ReechelonnementCredit
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
