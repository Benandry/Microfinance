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
                -- ammortissemnt
                -- ammortissement.periode,
                -- ammortissement.dateRemborsement,
                -- ammortissement.principale,
                -- ammortissement.interet,
                -- ammortissement.montanttTotal,
                -- ammortissement.codeclient,
                -- ammortissement.remboursement,
                -- ammortissement.annuite,
                -- ammortissement.penalite,
                -- ammortissement.commission,
                -- ammortissement.typeamortissement,
                -- ammortissement.codecredit as codecreditammortissement ,
                -- remboursement
                DISTINCT remboursement.id,
                remboursement.dateRemborsement as remboursementdate,
                -- Test si le montant est complet ou non
                CASE
                   WHEN ammortissement.montanttTotal = remboursement.remboursement THEN ammortissement.montanttTotal
                   ELSE (remboursement.remboursement)
                END as remboursementpaye,
                remboursement.penalite as remboursementpenalite,
                remboursement.commission as remboursementcommission,
                remboursement.codecredit as remboursementcodecredit
            FROM
            App\Entity\Remboursement remboursement
            INNER JOIN
            App\Entity\AmortissementFixe ammortissement
            WHERE
            ammortissement.codecredit = remboursement.codecredit
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
