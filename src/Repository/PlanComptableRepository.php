<?php

namespace App\Repository;

use App\Entity\PlanComptable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlanComptable>
 *
 * @method PlanComptable|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanComptable|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanComptable[]    findAll()
 * @method PlanComptable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanComptableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanComptable::class);
    }

    public function add(PlanComptable $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PlanComptable $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findPlanByAll()
    {
        $query = "SELECT
        plan
        FROM App\Entity\PlanComptable  plan
        ";

        $statement = $this->getEntityManager()->createQuery($query)->execute();

        return $statement;
    }

    public function findPlanById($numero)
    {
        $query = "SELECT
        plan
        FROM App\Entity\PlanComptable  plan
        WHERE plan.NumeroCompte = $numero
        ";

        $statement = $this->getEntityManager()->createQuery($query)->execute();

        return $statement;
    }
}
