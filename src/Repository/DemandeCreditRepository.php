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

    /**
     * Undocumented function
     *
     * @method mixed Ammortissement():Methode permet de recuperer le code credit pour afficher le tableau d'ammortissement
     * 
     * @param [type] $codecredit
     * @return void
     */
    public function Ammortissement($codecredit){
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT
                demande.Montant,
                demande.TauxInteretAnnuel,
                demande.NombreTranche,
                demande.TypeTranche,
                demande.codeclient
                FROM
                    App\Entity\DemandeCredit demande
                WHERE
                demande.NumeroCredit = :codecredit
            '
        )
        ->setParameter(':codecredit',$codecredit);

        return $query->getResult();
    }

    /**
     * Undocumented function
     *@method mixed InfoClientDemandeCreditIndividuel() : Mehode permet de connaitre l'information 
     *individuel
     *@param mixed $codeclient:code client individuel
     * @return void
     */
    public function InfoClientDemandeCreditIndividuel($codeclient){

        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT
                individuel.codeclient,
                individuel.nom_client,
                individuel.prenom_client
                FROM
                    App\Entity\IndividuelClient individuel
                WHERE
                    individuel.codeclient = :codeclient
            '
        )
        ->setParameter(':codeclient',$codeclient);

        return $query->getResult();

    }

        /**
     * Undocumented function
     *@method mixed InfoDemandeCreditModal():Methode permet d'afficher les informations individuel sur le modal demande credit
     * @param [type] $id: id client
     * @return void
     */
    public function InfoRemboursementModal($id)
    {
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
        'SELECT
            individuel.codeclient,
            individuel.nom_client,
            individuel.prenom_client,
            demande.NumeroCredit
            FROM
                App\Entity\IndividuelClient individuel
                LEFT JOIN
                App\Entity\DemandeCredit demande
                WITH
                individuel.codeclient=demande.codeclient
            WHERE
            demande.id = :id
            ORDER BY demande.id DESC
        '
        )
        ->setParameter('id',$id)
        ->setMaxResults(1);

        return $query->getResult();
    }


    /**
     * Undocumented function
     *@method mixed InfoDemandeCreditModal():Methode permet d'afficher les informations individuel sur le modal demande credit
     * @param [type] $id: id client
     * @return void
     */
    public function InfoDemandeCreditModal($id)
    {
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
        'SELECT
            individuel.codeclient,
            individuel.nom_client,
            individuel.prenom_client,
            demande.NumeroCredit
            FROM
                App\Entity\Individuelclient individuel
                LEFT JOIN
                App\Entity\DemandeCredit demande
                WITH
                individuel.codeclient=demande.codeclient
            WHERE
            individuel.id = :id
            ORDER BY demande.id DESC
        '
        )
        ->setParameter('id',$id)
        ->setMaxResults(1);

        return $query->getResult();
    }


        /**
     * Undocumented function
     *@method mixed InfoClientModalIndividuel() : Mehode permet de connaitre l'information 
     *individuel
     *@param mixed $NumeroCredit:code client individuel
     * @return void
     */
    public function InfoClientModalIndividuel($NumeroCredit){

        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT
                individuel.codeclient,
                individuel.nom_client,
                individuel.prenom_client
                FROM
                    App\Entity\DemandeCredit demande
                    INNER JOIN
                    App\Entity\IndividuelClient individuel
                    WITH
                    demande.codeclient=individuel.codeclient
                WHERE
                    demande.id = :NumeroCredit
            '
        )
        ->setParameter(':NumeroCredit',$NumeroCredit);

        return $query->getResult();

    }

       /**
     * Undocumented function
     *@method mixed InfoClientDemandeCreditGroupe() : Mehode permet de connaitre l'information 
     *groupe
     *@param mixed $codegroupe:code client groupe
     * @return void
     */
    public function InfoClientModalGroupe($NumeroCredit){

        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT
                groupe.nomGroupe,
                groupe.dateInscription,
                groupe.numeroMobile,
                groupe.email
                FROM
                    App\Entity\DemandeCredit demande
                    INNER JOIN
                    App\Entity\Groupe groupe
                    WITH
                    demande.codeclient=groupe.codegroupe
                WHERE
                    demande.NumeroCredit = :NumeroCredit
            '
        )
        ->setParameter(':NumeroCredit',$NumeroCredit);

        return $query->getResult();

    }

    /**
     * Undocumented function
     *
     * @method mixed InfoDemandeCreditGroupe():Methode permet d'afficher les informations groupes sur le modal demande credit
     * @param [type] $id
     * @return void
     */
    public function InfoDemandeCreditGroupe($id)
    {
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT
                groupe.nomGroupe,
                groupe.dateInscription,
                groupe.numeroMobile,
                groupe.codegroupe
                FROM
                    App\Entity\Groupe groupe
                WHERE
                    groupe.id = :id
            '
        )
        ->setParameter(':id',$id);

        return $query->getResult();

    }


       /**
     * Undocumented function
     *@method mixed InfoClientDemandeCreditGroupe() : Mehode permet de connaitre l'information 
     *groupe
     *@param mixed $codegroupe:code client groupe
     * @return void
     */
    public function InfoClientDemandeCreditGroupe($codegroupe){

        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT
                groupe.nomGroupe,
                groupe.dateInscription,
                groupe.numeroMobile,
                groupe.email
                FROM
                    App\Entity\Groupe groupe
                WHERE
                    groupe.codegroupe = :codegroupe
            '
        )
        ->setParameter(':codegroupe',$codegroupe);

        return $query->getResult();

    }

    /**
     * Undocumented function
     *@method mixed InfoGarant():Cette fonction permet de savoir 
     *si c'est un client garant ou pas
     *@param mixed $codeclient : code client individuel
     * @return void
     */
    public function InfoGarant($codeclient){

        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT
                individuel.codeclient,
                individuel.nom_client,
                individuel.prenom_client,
                individuel.cin
             FROM
                App\Entity\IndividuelClient individuel
             WHERE
                individuel.garant = 1
                    AND
                individuel.codeclient = :codeclient
            '
        )
        ->setParameter(':codeclient',$codeclient);

        return $query->getResult();
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
    /**
     * Undocumented function
     *
     * @param [type] $codeclient
     * @return void
     */
    public function getCycleCredit($codeclient)
    {
        $query = " SELECT COUNT(d.codeclient) nombre
            FROM App\Entity\DemandeCredit d
            WHERE d.codeclient = '$codeclient'
            ";
        $statement = $this->getEntityManager()->createQuery($query)->execute();

        return $statement;
    }
    /**
     * Undocumented function
     *
     * @method mixed FicheCredit():Methode permet de recuperer les donnees pour dresser une fiche de credit
     * @param [type] $idcredit
     * @return void
     */
    public function FicheCredit($NumeroCredit){

        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT
                fiche.Periode,
                fiche.NumeroCredit,
                fiche.DateTransaction,
                fiche.CapitalDu,
                fiche.InteretDu,
                fiche.CreditDu,
                fiche.Transaction,
                fiche.Capital,
                fiche.Interet,
                fiche.Total,
                fiche.Penalite,
                fiche.SoldeCourant
            FROM
                App\Entity\FicheDeCredit fiche
                -- LEFT JOIN
                -- App\Entity\DemandeCredit demande
                -- WITH demande.NumeroCredit=fiche.NumeroCredit
            WHERE
            fiche.NumeroCredit = :NumeroCredit
            -- GROUP BY fiche.id
            '
        )
        ->setParameter(':NumeroCredit',$NumeroCredit);

        return $query->getResult();
    }
}
