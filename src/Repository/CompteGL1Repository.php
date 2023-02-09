<?php

namespace App\Repository;

use App\Entity\CompteGL1;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompteGL1>
 *
 * @method CompteGL1|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompteGL1|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompteGL1[]    findAll()
 * @method CompteGL1[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteGL1Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompteGL1::class);
    }

    public function add(CompteGL1 $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CompteGL1 $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    public function findOneBySomeField($value): ?CompteGL1
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
