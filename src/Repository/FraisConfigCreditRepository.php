<?php

namespace App\Repository;

use App\Entity\FraisConfigCredit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FraisConfigCredit>
 *
 * @method FraisConfigCredit|null find($id, $lockMode = null, $lockVersion = null)
 * @method FraisConfigCredit|null findOneBy(array $criteria, array $orderBy = null)
 * @method FraisConfigCredit[]    findAll()
 * @method FraisConfigCredit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FraisConfigCreditRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FraisConfigCredit::class);
    }

    public function add(FraisConfigCredit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FraisConfigCredit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return FraisConfigCredit[] Returns an array of FraisConfigCredit objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FraisConfigCredit
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
