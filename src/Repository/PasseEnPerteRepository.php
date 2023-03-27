<?php

namespace App\Repository;

use App\Entity\PasseEnPerte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PasseEnPerte>
 *
 * @method PasseEnPerte|null find($id, $lockMode = null, $lockVersion = null)
 * @method PasseEnPerte|null findOneBy(array $criteria, array $orderBy = null)
 * @method PasseEnPerte[]    findAll()
 * @method PasseEnPerte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PasseEnPerteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PasseEnPerte::class);
    }

    public function save(PasseEnPerte $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PasseEnPerte $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PasseEnPerte[] Returns an array of PasseEnPerte objects
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

//    public function findOneBySomeField($value): ?PasseEnPerte
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
