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

    public function findDemnadeCreditOne(\DATETIME $date_arreter)
    {

        $query = "SELECT DISTINCT
        d.NumeroCredit,
        d.DateDemande,
        d.Montant,
        d.NombreTranche,
        d.Agent,
        client.nom_client,
        client.prenom_client,
        appro.statusApprobation
        FROM App\Entity\DemandeCredit d 
        INNER JOIN App\Entity\Individuelclient client
        WITH d.codeclient = client.codeclient

        LEFT JOIN App\Entity\ApprobationCredit appro
        WITH appro.codecredit = d.NumeroCredit
        WHERE d.DateDemande <= :arreter
        ";

        $statement = $this->getEntityManager()->createQuery($query)
        ->setParameter('arreter',$date_arreter)
        ->execute();

        return $statement;
    }

    public function findDemnadeCredit(\DATETIME $date_debut,\DATETIME $date_fin)
    {

        $query = "SELECT DISTINCT
        d.NumeroCredit,
        d.DateDemande,
        d.Montant,
        d.NombreTranche,
        d.Agent,
        client.nom_client,
        client.prenom_client,
        appro.statusApprobation
        FROM App\Entity\DemandeCredit d 
        INNER JOIN App\Entity\Individuelclient client
        WITH d.codeclient = client.codeclient

        
        LEFT JOIN App\Entity\ApprobationCredit appro
        WITH appro.codecredit = d.NumeroCredit
        
        WHERE d.DateDemande >= :debut AND d.DateDemande <= :fin 
        ";

        $statement = $this->getEntityManager()->createQuery($query)
        ->setParameter('debut',$date_debut)
        ->setParameter('fin',$date_fin)
        ->execute();

        return $statement;
    }

    public function getCycleCredit($codeclient)
    {
        $query = " SELECT COUNT(d.codeclient) nombre
            FROM App\Entity\DemandeCredit d
            WHERE d.codeclient = '$codeclient'
            ";
        $statement = $this->getEntityManager()->createQuery($query)->execute();

        return $statement;
    }
}
