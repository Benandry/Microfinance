<?php

namespace App\Repository;

use App\Entity\Individuelclient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @extends ServiceEntityRepository<Individuelclient>
 *
 * @method Individuelclient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Individuelclient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Individuelclient[]    findAll()
 * @method Individuelclient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndividuelclientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Individuelclient::class);
    }

    public function add(Individuelclient $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Individuelclient $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

        /**
     * Undocumented function
     *@method mixed AjoutMembre():Cette methode permet d'ajouter des membres groupe
     * @param [type] $idclient
     * @return array
     */

     public function AjoutMembre($idclient){
        $entityManager=$this->getEntityManager();
  
        $query=$entityManager->createQuery(
          'SELECT
          i
          FROM
          App\Entity\Individuelclient  i
          WHERE
          i.id=:idclient'
        )
        ->setParameter(':idclient',$idclient);
  
        return $query->getResult();
      }
  

    /**
     * Undocumented function
     *@method mixed profil():Cette methode affiche le client à changer en garant
     * @param integer $idclient
     * @return array
     */
    public function profil(int $idclient):array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT 
            i
            FROM App\Entity\Individuelclient i
            WHERE
            i.id = :idclient'
        )->setParameter('idclient',$idclient);

        return $query->getResult();
    }

    /**
     * Undocumented function
     *@method mixed ListeGarant():Permet de lister tout les garants
     * @return void
     */
    public function ListeGarant()
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT 
                i.codeclient,
                i.nom_client,
                i.prenom_client,
                i.cin,
                i.date_inscription,
                i.sexe
            FROM 
                App\Entity\Individuelclient i
            WHERE
                i.garant = true'
        );

        return $query->getResult();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
   public function CompteEpargne()
   {
       return $this->createQueryBuilder('i')
            ->leftJoin('i.codecompteepargne','c')
            ->where('c.codeclient = i.id')
        //    ->andWhere('i.CodeAgence = :val')
        //    ->setParameter('val', $value)
        //    ->orderBy('i.id', 'ASC')
            ->groupBy('i.id')
           ->getQuery()
           ->getResult();

   }

   public function Recherche($nom)
   {
       return $this->createQueryBuilder('i')
           ->where('i.nom_client = :nom')
           ->setParameter('nom',$nom)
           ->getQuery()
           ->getResult()
       ;
   }
   
   public function Filtre($du)
   {
        return $this->createQueryBuilder('i')
        ->where('i.date_inscription = :du')
        ->setParameter(':du',$du)
        ->getQuery()
        ->getResult();
   }

    
   //    Cette fonction permet de trier les rapoort client entre deux date
    public function trierRapportClient ($date1=null,$date2=null)
    {
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT i
            FROM App\Entity\Individuelclient i
            WHERE i.date_inscription
            BETWEEN :date1 AND :date2
            AND i.garant = 0 ')
            ->setParameter('date1',$date1)
            ->setParameter('date2',$date2);

            return $query->getResult();
    }

     //    Cette fonction permet de trier les rapoort client une date
     public function trierRapportClient_one_date($date)
     {
         $entityManager=$this->getEntityManager();
 
         $query=$entityManager->createQuery(
             'SELECT i
              FROM App\Entity\Individuelclient i
              WHERE i.date_inscription <=  :date2 
              AND i.garant = 0 
              ORDER BY i.date_inscription ASC')
             ->setParameter('date2',$date);
 
             return $query->getResult();
    }


    //// MAKA An ilay id agence anaovana codeclient /////

    public function findByAgenceCode(){

        $query = 'SELECT
         agence.id
         FROM App\Entity\Agence agence WHERE agence.id = 1';

        $statement = $this->getEntityManager()->createQuery($query)->execute();

        return $statement;
    }

    public function findByLastClient(){

        $query = 'SELECT
         MAX(individu.id)
         FROM 
         App\Entity\Individuelclient individu';

        $statement = $this->getEntityManager()->createQuery($query)->execute();

        return $statement;
    }

    /// MAka an an ilayy client ho modifier  ///
    public function FindByClientToModify($id_client){
        $query = "SELECT client.id, client.nom_client FROM App\Entity\IndividuelClient client WHERE client.id = $id_client";
        $statement = $this->getEntityManager()->createQuery($query)->execute();
        return $statement;
    }

    ///Rechercher client  carte d'identite par date
    public function trierRapportClientPar_une_date($date){
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
                "SELECT i
                FROM App\Entity\Individuelclient i
                WHERE
                i.date_inscription <= :date1 AND i.garant = 0
             ")
            ->setParameter('date1',$date);

            return $query->getResult();   
    }


     ///Rechercher client  par agent 
     public function findClientByAgent($user){

        // dd($user);
        $query = "SELECT 
        client
        FROM App\Entity\Individuelclient client
        WHERE client.garant = 0 
        AND client.user = $user
        ";

        
        $stmt = $this->getEntityManager()->createQuery($query)->execute();

        return $stmt;
    }


    /*****Information adresse du client ********* */
   public function InfoCommuneClient($id)
   {
        $query = " SELECT  client.id,client.nom_client, commune.NomCommune ,commune.CodeCommune,client.adressephysique
        FROM App\Entity\Individuelclient client
        LEFT JOIN App\Entity\Commune commune
        WITH client.commune = commune.NomCommune 
        WHERE client.id = '$id'";
        
        $stmt = $this->getEntityManager()->createQuery($query)->getResult();

        return $stmt;
   }

   public function findAllClient()
   {
        $query = " SELECT  client
        FROM App\Entity\Individuelclient client
        ";
        
        $stmt = $this->getEntityManager()->createQuery($query)->getResult();

        return $stmt;
   }
   
    /**
     * Fonction qui recupere le client s'il la numero cin qui correspond
     * 
     */
    public function findByNumeroCin($numero_cin){

        $query = "SELECT
         i
         FROM 
         App\Entity\Individuelclient i
         WHERE i.cin = $numero_cin";

        $statement = $this->getEntityManager()->createQuery($query)->execute();

        return $statement;
    }

    public function FindByClientByGroupe($groupe){
        $query = "SELECT client
                 FROM App\Entity\IndividuelClient client
                 WHERE client.MembreGroupe = $groupe
                 ";
        $statement = $this->getEntityManager()->createQuery($query)->execute();
        return $statement;
    }
}
