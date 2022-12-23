<?php

namespace App\Repository;

use App\Entity\DemandeCredit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DemandeCredit>
 *
 * @method DemandeCredit|null find($id, $lockMode = null, $lockVersion = null)
 * @method DemandeCredit|null findOneBy(array $criteria, array $orderBy = null)
 * @method DemandeCredit[]    findAll()
 * @method DemandeCredit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandeCreditRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DemandeCredit::class);
    }

    public function add(DemandeCredit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DemandeCredit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // Cette fonction permet de creer des numero credits
    public function DernierNumeroCredit(){
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT
             MAX(demande.id)
             FROM 
             App\Entity\DemandeCredit demande'
        );

        return $query->execute();
    }

    public function findDemnadeCredit($date1, $date2)
    {
        $query = "SELECT DISTINCT
        d
        FROM App\Entity\DemandeCredit d
        ";

        $statement = $this->getEntityManager()->createQuery($query)->execute();

        return $statement;
    }

}
