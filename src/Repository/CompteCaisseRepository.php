<?php

namespace App\Repository;

use App\Entity\CompteCaisse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompteCaisse>
 *
 * @method CompteCaisse|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompteCaisse|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompteCaisse[]    findAll()
 * @method CompteCaisse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteCaisseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompteCaisse::class);
    }

    public function save(CompteCaisse $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CompteCaisse $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findMaxIdCaisse()
    {
        $query = "SELECT
            MAX(caisse.id)
        FROM App\Entity\CompteCaisse caisse
        ";

        $statement = $this->getEntityManager()->createQuery($query)->execute();

        return $statement;
    }
}
