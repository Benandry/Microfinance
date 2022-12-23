<?php

namespace App\Repository;

use App\Entity\Decaissement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Decaissement>
 *
 * @method Decaissement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Decaissement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Decaissement[]    findAll()
 * @method Decaissement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DecaissementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Decaissement::class);
    }

    public function add(Decaissement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Decaissement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function decaissementApprouver(string $codeCredit)
    {
        $query = "SELECT
        a.id,
        a.dateApprobation,
        a.description,
        a.statusApprobation,
        a.montant,
        a.codecredit
        FROM App\Entity\ApprobationCredit a
        where a.codecredit = '$codeCredit'
        ";

        $statement = $this->getEntityManager()->createQuery($query)->execute();

        return $statement;
    }
}
