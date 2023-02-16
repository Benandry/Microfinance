<?php

namespace App\Repository;

use App\Entity\Agence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Agence>
 *
 * @method Agence|null find($id, $lockMode = null, $lockVersion = null)
 * @method Agence|null findOneBy(array $criteria, array $orderBy = null)
 * @method Agence[]    findAll()
 * @method Agence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Agence::class);
    }

    public function add(Agence $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Agence $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

        public function ListeAgence()
        {
            $entityManager = $this->getEntityManager();

            $query = $entityManager->createQuery(
                'SELECT
               a
                FROM 
                App\Entity\Agence a
                '
            );

            return $query->getResult();
        }

        public function findClientParAgence($agence)
        {
            $query = "SELECT 
             client
             FROM App\Entity\Individuelclient client
             WHERE client.Agence = $agence
             AND client.garant = 0
             ";

             $statement = $this->getEntityManager()
                ->createQuery($query)
                ->execute();        
             return $statement;
        }

        public function getIdMax()
        {
            $query = "SELECT MAX(agence.id) FROM App\Entity\Agence agence";
            $statement = $this->getEntityManager()->createQuery($query)->execute();
            return $statement;
        }
}
