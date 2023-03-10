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

    /**
     * Undocumented function
     *
     * @method mixed IndividuelInfoDecaissementModal():Information utile dans le modal decaissement
     * @param [type] $id
     * @return void
     */
    public function IndividuelInfoDecaissementModal($id){
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT
        client.nom_client,
        client.prenom_client,
        demande.codeclient,
        demande.NumeroCredit,
        demande.Montant,
        decaissement.numeroCredit,
        decaissement.NumeroCompteEpargne

        FROM App\Entity\DemandeCredit demande
        INNER JOIN 
        App\Entity\Individuelclient client
        With demande.codeclient = client.codeclient 

        LEFT JOIN 
        App\Entity\ApprobationCredit appro
        With appro.codecredit = demande.NumeroCredit

        LEFT JOIN 
        App\Entity\Decaissement decaissement
        With decaissement.numeroCredit = appro.codecredit

        where  client.id=:id
        AND decaissement.numeroCredit IS NULL
            '
        )
        ->setParameter(':id',$id);

        return $query->getResult();
    }


    /**
     * @method mixed decaissementApprouverIndividuel()
     */

    public function decaissementApprouverIndividuel($Client)
    {
        $query = "SELECT
        client.nom_client,
        client.prenom_client,
        demande.codeclient,
        demande.NumeroCredit,
        demande.Montant,
        appro.statusApprobation,
        decaissement.numeroCredit,
        decaissement.NumeroCompteEpargne

        FROM App\Entity\DemandeCredit demande
        INNER JOIN 
        App\Entity\Individuelclient client
        With demande.codeclient = client.codeclient 

        LEFT JOIN 
        App\Entity\ApprobationCredit appro
        With appro.codecredit = demande.NumeroCredit

        LEFT JOIN 
        App\Entity\Decaissement decaissement
        With decaissement.numeroCredit = appro.codecredit

        where appro.statusApprobation = 'approuv??'
        AND client.id=:Client
        AND decaissement.numeroCredit IS NULL
        ";

        $statement = $this->getEntityManager()->createQuery($query)->setParameter(':Client',$Client)->execute();

        return $statement;
    }

    //Liste de individuelclient approuver
    public function decaissementApprouverGroupe()
    {
        $query = "SELECT
        groupe.nomGroupe,
        groupe.numeroMobile,
        demande.NumeroCredit,
        demande.codeclient,
        demande.Montant,
        appro.statusApprobation,
        decaissement.numeroCredit

        FROM App\Entity\DemandeCredit demande
        INNER JOIN 
        App\Entity\Groupe groupe
        With demande.codeclient = groupe.codegroupe 

        LEFT JOIN 
        App\Entity\ApprobationCredit appro
        With appro.codecredit = demande.NumeroCredit

        LEFT JOIN 
        App\Entity\Decaissement decaissement
        With decaissement.numeroCredit = appro.codecredit

        where appro.statusApprobation = 'approuv??'
        AND decaissement.numeroCredit IS NULL
        ";

        $statement = $this->getEntityManager()->createQuery($query)->execute();

        return $statement;
    }



    public function rapportDecaissement()
    {
        $query = "SELECT
        client.nom_client,
        client.prenom_client,
        demande.NumeroCredit,
        demande.Montant,
        demande.DateDemande,
<<<<<<< HEAD
        appro.dateApprobation,
        user.prenom agent ,
        decaissement.dateDecaissement
        
=======
        demande.Agent AgentdeCreditDemande,
        appro.dateApprobation,
        user.prenom AgentDeCreditApprouver,
        decaissement.dateDecaissement,
        user.prenom AgentDeCreditDecaissement 

>>>>>>> refs/remotes/origin/main
        FROM App\Entity\DemandeCredit demande
        INNER JOIN 
        App\Entity\Individuelclient client
        With demande.codeclient = client.codeclient 

        LEFT JOIN 
        App\Entity\ApprobationCredit appro
        With appro.codecredit = demande.NumeroCredit

        LEFT JOIN 
        App\Entity\Decaissement decaissement
        With decaissement.numeroCredit = appro.codecredit
<<<<<<< HEAD

        INNER JOIN 
        App\Entity\User user
        With user.id = demande.agent 
=======
        INNER JOIN 
        App\Entity\User user
        With user.id = appro.agentCredit 
>>>>>>> refs/remotes/origin/main

        where appro.statusApprobation = 'approuv??'
        AND decaissement.numeroCredit IS NOT NULL
        ";

        $statement = $this->getEntityManager()->createQuery($query)->execute();

        return $statement;
    }

    public function findByCycle($codecredit)
    {
        $query = " SELECT MAX(d.cycles)
            FROM App\Entity\DemandeCredit d
            WHERE d.codeclient = '$codecredit'
            ";
        $statement = $this->getEntityManager()->createQuery($query)->execute();

        return $statement;
    }


}
