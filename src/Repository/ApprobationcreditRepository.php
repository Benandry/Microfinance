<?php

namespace App\Repository;

use App\Entity\ApprobationCredit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ApprobationCredit>
 *
 * @method ApprobationCredit|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApprobationCredit|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApprobationCredit[]    findAll()
 * @method ApprobationCredit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApprobationCreditRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApprobationCredit::class);
    }

    public function add(ApprobationCredit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ApprobationCredit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ApprobationCredit[] Returns an array of ApprobationCredit objects
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

//    public function findOneBySomeField($value): ?ApprobationCredit
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


// Liste des demande client Individuel
    public function findDemandeNonApprouver()
    {
        $query = "SELECT
        client.nom_client,
        client.prenom_client,
        demande.NumeroCredit,
        demande.codeclient,
        demande.Montant,
        demande.DateDemande ,
        demande.NombreTranche ,
        demande.TypeTranche,
        --appro.id
        -- appro.statusApprobation,
            appro.codecredit

        FROM App\Entity\DemandeCredit demande
        INNER JOIN 
        App\Entity\Individuelclient client
        With demande.codeclient = client.codeclient 

            LEFT JOIN 
            App\Entity\ApprobationCredit appro
            With appro.codecredit = demande.NumeroCredit
            where appro.codecredit IS NULL 

        ";

        $statement = $this->getEntityManager()->createQuery($query)->execute();

        return $statement;
    }

    public function getDemandeApprouver($date, string $status)
    {
        $query = "SELECT
        client.nom_client,
        client.prenom_client,
        demande.NumeroCredit,
        demande.codeclient,
        demande.Montant,
        demande.NombreTranche ,
        demande.TypeTranche,
        --appro.id
            appro.statusApprobation,
            appro.codecredit,
            appro.dateApprobation,
            appro.description
        --  appro.utilisateur

        FROM App\Entity\DemandeCredit demande
        INNER JOIN 
        App\Entity\Individuelclient client
        With demande.codeclient = client.codeclient 

            LEFT JOIN 
            App\Entity\ApprobationCredit appro
            With appro.codecredit = demande.NumeroCredit
            where appro.statusApprobation = '$status'
            AND appro.dateApprobation <= :date1 

        ";

        $statement = $this->getEntityManager()
        ->createQuery($query)
            ->setParameter('date1',$date)
        ->execute();

        return $statement;
    }

    public function getDemandeApprouverDeuxDate($debut,$fin,string $status)
    {
        $query = "SELECT
        client.nom_client,
        client.prenom_client,
        demande.NumeroCredit,
        demande.codeclient,
        demande.Montant,
        demande.NombreTranche ,
        demande.TypeTranche,
        --appro.id
            appro.statusApprobation,
            appro.codecredit,
            appro.dateApprobation,
            appro.description
        --  appro.utilisateur

        FROM App\Entity\DemandeCredit demande
        INNER JOIN 
        App\Entity\Individuelclient client
        With demande.codeclient = client.codeclient 

            LEFT JOIN 
            App\Entity\ApprobationCredit appro
            With appro.codecredit = demande.NumeroCredit
            where appro.statusApprobation = '$status'
            AND appro.dateApprobation >= :debut 
            AND appro.dateApprobation <= :fin  

        ";

        $statement = $this->getEntityManager()
        ->createQuery($query)
            ->setParameter('debut',$debut)
            ->setParameter('fin',$fin)
        ->execute();

        return $statement;
    }

    public function findCycle($codeclient)
    {
        $query = " SELECT MAX(d.cycles)
            FROM App\Entity\DemandeCredit d
            WHERE d.codeclient = '$codeclient'
            ";
        $statement = $this->getEntityManager()->createQuery($query)->execute();

        return $statement;
    }

    // Liste des demande client 
    public function findDemandeNonApprouverGroupe()
    {
        $query = "SELECT
        groupe.nomGroupe,
        groupe.numeroMobile,
        demande.NumeroCredit,
        demande.codeclient,
        demande.Montant,
        demande.DateDemande ,
        demande.NombreTranche ,
        demande.TypeTranche,
        --appro.id
        -- appro.statusApprobation,
        appro.codecredit

        FROM App\Entity\DemandeCredit demande
        INNER JOIN 
        App\Entity\Groupe groupe
        With demande.codeclient = groupe.codegroupe 

        LEFT JOIN 
        App\Entity\ApprobationCredit appro
        With appro.codecredit = demande.NumeroCredit
        where appro.codecredit IS NULL 

        ";

        $statement = $this->getEntityManager()->createQuery($query)->execute();

        return $statement;
    }
}
