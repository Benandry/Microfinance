<?php

namespace App\Repository;

use App\Entity\MouvementComptable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MouvementComptable>
 *
 * @method MouvementComptable|null find($id, $lockMode = null, $lockVersion = null)
 * @method MouvementComptable|null findOneBy(array $criteria, array $orderBy = null)
 * @method MouvementComptable[]    findAll()
 * @method MouvementComptable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MouvementComptableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MouvementComptable::class);
    }

    public function save(MouvementComptable $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MouvementComptable $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

<<<<<<< HEAD
    public function findJournal($debut,$fin): array
    {
        $query = "SELECT 
                journal.dateMouvement,
                journal.pieceComptable,
                journal.debit,
                journal.credit,
                compta.NumeroCompte,
                compta.Libelle
            FROM 
            App\Entity\MouvementComptable journal

            INNER JOIN
            App\Entity\PlanComptable compta
            with compta.id = journal.planCompta
            WHERE journal.dateMouvement BETWEEN :debut AND :fin
        ";

        $stmt = $this->getEntityManager()
                ->createQuery($query)
                ->setParameter(':debut',$debut)
                ->setParameter(':fin',$fin)
                ->execute();

        return $stmt;
    }

    public function findByGrandLivre($debut,$fin): array
    {
        $query = "SELECT 
                livre.dateMouvement,
                livre.pieceComptable,
                livre.description,
                livre.description,
                compta.NumeroCompte,
                compta.Libelle,
                livre.debit,
                livre.credit,
                livre.solde,
                livre.refTransaction
                FROM 
                App\Entity\MouvementComptable livre
                INNER JOIN
                App\Entity\PlanComptable compta
                with compta.id = livre.planCompta
                WHERE livre.dateMouvement BETWEEN :debut AND :fin
                -- GROUP BY livre.refTransaction
        ";

        $stmt = $this->getEntityManager()
                ->createQuery($query)
                ->setParameter(':debut',$debut)
                ->setParameter(':fin',$fin)
                ->execute();

        return $stmt;
    }

    public function getBalance()
    {
        $query = "SELECT
         compta.NumeroCompte,
         compta.Libelle,
        --  SUM (balance.solde) solde
        balance.debit,
        balance.credit,
        balance.solde
         FROM  
        App\Entity\MouvementComptable balance
        INNER JOIN
        App\Entity\PlanComptable compta
        with compta.id = balance.planCompta
        INNER JOIN
        App\Entity\Classes classe
        with compta.classes = classe.id

        WHERE classe.numero_classe = 1
        -- GROUP BY compta.NumeroCompte
        ";

        $stmt = $this->getEntityManager()
        ->createQuery($query)
        ->execute();
=======
    public function findJournal(): array
    {
        $query = "
            SELECT journal 
            FROM 
            App\Entity\MouvementComptable journal
        ";

        $stmt = $this->getEntityManager()->createQuery($query)->execute();
>>>>>>> refs/remotes/origin/main

        return $stmt;
    }
}
