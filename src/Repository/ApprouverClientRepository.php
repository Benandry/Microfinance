<?php

namespace App\Repository;

use App\Entity\ApprouverClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ApprouverClient>
 *
 * @method ApprouverClient|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApprouverClient|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApprouverClient[]    findAll()
 * @method ApprouverClient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApprouverClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApprouverClient::class);
    }

    public function add(ApprouverClient $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ApprouverClient $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   public function Approbation()
   {

    $entityManager=$this->getEntityManager();
    
    $query=$entityManager->createQuery(
        'SELECT 
        a.id,(a.codeclient) AS codecl,(a.dateapprobation) AS  dateapp ,
        (i.nom_client) AS nom,
        (i.prenom_client) AS prenom
         FROM App\Entity\ApprouverClient a
         INNER JOIN App\Entity\Individuelclient i
         WHERE i.id = a.codeclient ');

    return $query->getResult();
   }

//    public function findOneBySomeField($value): ?ApprouverClient
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
