<?php

namespace App\Repository;

use App\Entity\JournalComptabilite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JournalComptabilite>
 *
 * @method JournalComptabilite|null find($id, $lockMode = null, $lockVersion = null)
 * @method JournalComptabilite|null findOneBy(array $criteria, array $orderBy = null)
 * @method JournalComptabilite[]    findAll()
 * @method JournalComptabilite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JournalComptabiliteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JournalComptabilite::class);
    }

    public function add(JournalComptabilite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(JournalComptabilite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return JournalComptabilite[] Returns an array of JournalComptabilite objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?JournalComptabilite
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
