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

    public function RemboursementCredit($codecredit){
        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'SELECT 
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
            App\Entity\AmortissementFixe remboursement
            WHERE
            remboursement.codecredit = :codecredit
            '
        )
        ->setParameter(':codecredit',$codecredit);

        return $query->getResult();
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

    public function findAmortissement(string $codeCredit)
    {
        $query = "SELECT
        a.id,
        a.periode ,
        a.dateRemborsement,
        a.principale,
        a.interet,
        a.montanttTotal ,
        a.remboursement,
        a.annuite,
        a.codecredit
        FROM App\Entity\AmortissementFixe a
        where a.codecredit = '$codeCredit'

        ";

        $statement = $this->getEntityManager()->createQuery($query)->execute();

        return $statement;
    }

    public function findInfoCredit(string $codeCredit)
    {
        $query = "SELECT
        d.NumeroCredit,
        d.Montant,
        d.NombreTranche ,
        d.TauxInteretAnnuel,
        a.annuite,
        a.remboursement
        FROM App\Entity\DemandeCredit d
        LEFT JOIN
        App\Entity\AmortissementFixe a
        WITH a.codecredit= d.NumeroCredit
        where d.NumeroCredit = '$codeCredit'
        ";

        $statement = $this->getEntityManager()->createQuery($query)->setMaxResults(1)->execute();

        return $statement;
    }

}
