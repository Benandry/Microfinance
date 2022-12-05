<?php

namespace App\Repository;

use App\Entity\AmortissementFixe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AmortissementFixe>
 *
 * @method AmortissementFixe|null find($id, $lockMode = null, $lockVersion = null)
 * @method AmortissementFixe|null findOneBy(array $criteria, array $orderBy = null)
 * @method AmortissementFixe[]    findAll()
 * @method AmortissementFixe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AmortissementFixeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AmortissementFixe::class);
    }

    public function add(AmortissementFixe $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AmortissementFixe $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AmortissementFixe[] Returns an array of AmortissementFixe objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AmortissementFixe
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
