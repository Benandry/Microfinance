<?php

namespace App\Repository;

use App\Entity\Remboursement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

// use Symfony\Component\Validator\Constraints\Date;

/**
 * @extends ServiceEntityRepository<Remboursement>
 *
 * @method Remboursement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Remboursement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Remboursement[]    findAll()
 * @method Remboursement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RemboursementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Remboursement::class);
    }

    public function add(Remboursement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Remboursement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // ici on recupere les date qui correspond au mois actuel
    
    public function Remboursement($codecredit){
        $entityManager=$this->getEntityManager();

        $mois=date('m');
        
        $query=$entityManager->createQuery(
            "SELECT 
                remboursement.id,
                remboursement.periode,
                remboursement.dateRemborsement,
                remboursement.principale,
                remboursement.interet,
                remboursement.montanttTotal,
                remboursement.codeclient,
                remboursement.remboursement,
                remboursement.annuite,
                remboursement.penalite,
                remboursement.commission,
                remboursement.codecredit,
                remboursement.typeamortissement
            FROM
            App\Entity\Remboursement remboursement
            WHERE
            Month(remboursement.dateRemborsement) = '$mois'
            AND 
            remboursement.codecredit = :codecredit
            "
        )
        ->setParameter(':codecredit',$codecredit);

        return $query->getResult();
    }

//    /**
//     * @return Remboursement[] Returns an array of Remboursement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Remboursement
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
