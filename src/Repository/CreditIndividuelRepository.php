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
