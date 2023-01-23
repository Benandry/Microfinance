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

    public function findJournal(): array
    {
        $query = "
            SELECT journal 
            FROM 
            App\Entity\MouvementComptable journal
        ";

        $stmt = $this->getEntityManager()->createQuery($query)->execute();

        return $stmt;
    }

    public function findByGrandLivre(): array
    {
        $query = "
            SELECT journal 
            FROM 
            App\Entity\MouvementComptable journal
        ";

        $stmt = $this->getEntityManager()->createQuery($query)->execute();

        return $stmt;
    }
}
