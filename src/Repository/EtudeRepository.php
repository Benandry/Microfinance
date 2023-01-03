<?php

namespace App\Repository;

use App\Entity\Etude;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Etude>
 *
 * @method Etude|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etude|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etude[]    findAll()
 * @method Etude[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etude::class);
    }

    public function add(Etude $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Etude $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function nombreClient()
    {
        $query = "SELECT client FROM App\Entity\Individuelclient client";

        $statement = $this->getEntityManager()->createQuery($query)->execute();

        return $statement;
    }

    public function nombreGroupe()
    {
        $query = "SELECT groupe FROM App\Entity\Groupe groupe";

        $statement = $this->getEntityManager()->createQuery($query)->execute();

        return $statement;
    }

    public function nombreEpargne()
    {
        $query = "SELECT ce FROM App\Entity\CompteEpargne ce";

        $statement = $this->getEntityManager()->createQuery($query)->execute();

        return $statement;
    }

    public function nombreAgence()
    {
        $query = "SELECT a FROM App\Entity\Agence a";

        $statement = $this->getEntityManager()->createQuery($query)->execute();

        return $statement;
    }

}
