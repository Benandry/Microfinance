<?php

namespace App\Repository;

use App\Entity\Commune;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commune>
 *
 * @method Commune|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commune|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commune[]    findAll()
 * @method Commune[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommuneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commune::class);
    }

    public function add(Commune $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Commune $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Commune[] Returns an array of Commune objects
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

   public function api_commune()
   {
        $statement = $this->getEntityManager()->createQuery('SELECT c.CodeCommune Code,c.NomCommune Commune FROM App\Entity\Commune c')->execute();        
        return $statement;
     
   }

   public function findClientParCommune($commune,$debut,$fin)
   {
       $query = "SELECT 
        client
        FROM App\Entity\Individuelclient client
        WHERE client.commune = $commune
        AND client.date_inscription >= :debut
        AND client.date_inscription <= :fin 
        AND client.garant = 0
        ";

        $statement = $this->getEntityManager()
            ->createQuery($query)
            ->setParameter('debut',$debut)
            ->setParameter('fin',$fin)
            ->execute();        
        return $statement;
   }
}