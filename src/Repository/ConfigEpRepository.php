<?php

namespace App\Repository;

use App\Entity\ConfigEp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConfigEp>
 *
 * @method ConfigEp|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConfigEp|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConfigEp[]    findAll()
 * @method ConfigEp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConfigEpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConfigEp::class);
    }

    public function add(ConfigEp $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ConfigEp $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   public function Configuration()
   {
       return $this->createQueryBuilder('c')
           ->leftJoin('c.produitEpargne','p')
           ->where('p.id = c.produitEpargne')
            // ->groupBy('c.id')
           ->getQuery()
           ->getResult()
       ;
   }

//    public function findOneBySomeField($value): ?ConfigEp
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
