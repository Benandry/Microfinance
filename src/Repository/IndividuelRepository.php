<?php

namespace App\Repository;

use App\Entity\Individuelclient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Individuel>
 *
 * @method Individuel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Individuel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Individuel[]    findAll()
 * @method Individuel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndividuelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Individuel::class);
    }

    public function add(Individuelclient $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Individuelclient $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    
    public function Client()
    {
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT i FROM App\Entity\Individuelclient i WHERE i.listeRouges NOT NULL'
        );
        return $query->getResult();
    }

//    /**
//     * @return Individuel[] Returns an array of Individuel objects
//     */
//    public function findByExampleField($id): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.Indivisuelclient = :id')
//            ->setParameter('val', $id)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

   public function FiltreRappport($date1,$date2)
   {
            $entityManager=$this->getEntityManager();

            $query=$entityManager->createQuery(
                'SELECT 
                i
                 FROM App\Entity\Individuelclient i WHERE i.date_inscription BETWEEN :date1 AND :date2 '
            )
            ->setParameter('date1',$date1)
            ->setParameter('date2',$date2)
            ;
            return $query->getResult();

   }
}
