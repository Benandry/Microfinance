<?php

namespace App\Repository;

use App\Entity\Groupe;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Groupe>
 *
 * @method Groupe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Groupe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Groupe[]    findAll()
 * @method Groupe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Groupe::class);
    }

    public function add(Groupe $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Groupe $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


   public function Groupe()
   {
        $entityManager=$this->getEntityManager();
          $query=$entityManager->createQuery(
            'SELECT g FROM App\Entity\Groupe g');

        return $query->getResult();
   }

   public function RapportGroupe()
   {
        $entityManager=$this->getEntityManager();
          $query=$entityManager->createQuery(
            'SELECT 
            i,
            g.id,
            g.nomGroupe,
            g.email,
            g.dateInscription,
            COUNT(g.id) as NOMBRE
             FROM 
             App\Entity\Groupe g
             INNER JOIN 
             App\Entity\Individuelclient i
              WHERE 
              g.IndividuelMembre = i.id');

        return $query->getResult();
   }

   public function FiltreGroupe($date1,$date2)
   { 

        $query = "SELECT COUNT(client.id) nombre_par_membre, g.codegroupe,g.nomGroupe,g.email,g.dateInscription FROM App\Entity\Groupe g
                LEFT JOIN App\Entity\Individuelclient client WITH g.id = client.MembreGroupe
                WHERE g.dateInscription BETWEEN :date1 AND :date2
                GROUP BY g.id";
        $statement =
        $this->getEntityManager()
        ->createQuery($query)
        ->setParameter(':date1',$date1)
        ->setParameter(':date2',$date2)
        ->execute();

        return $statement;
    }

    ///Filtre par une date 

    public function filtre_groupe_one_date($one_date){

      $query = "SELECT COUNT(client.id) nombre_par_membre, g.codegroupe,g.nomGroupe,g.email,g.dateInscription FROM App\Entity\Groupe g
      LEFT JOIN App\Entity\Individuelclient client WITH g.id = client.MembreGroupe
      WHERE g.dateInscription <= :one_date GROUP BY g.id";

      $stm = $this->getEntityManager()->createQuery($query)->setParameter(':one_date',$one_date)->execute();
      return $stm;
    }

   public function RapportMembre()
   {
        $entityManager=$this->getEntityManager();
          $query=$entityManager->createQuery(
            'SELECT 
            g.id,
            g.nomGroupe,
            g.email,
            g.dateInscription,
            i.id as client,
            i.nom_client,
            i.prenom_client,
            i.dateadhesion,
            i.codeclient,
            g.codegroupe
            FROM 
            App\Entity\Groupe g
            INNER JOIN
            App\Entity\Individuelclient i
            with g.id = i.MembreGroupe
            WHERE i.garant = 0 
              ');

        return $query->getResult();
   }

      // Filtre entre deux date transaction
       // Filtre entre deux date transaction
       public function filtreMembre($date1,$date2){

        $query = "SELECT  
                  g.codegroupe,
                 client.codeclient,
                  client.dateadhesion , 
                  client.nom_client ,
                  client.prenom_client,
                  g.email ,
                  g.nomGroupe ,
                  g.email

                FROM App\Entity\Groupe g
                INNER JOIN App\Entity\Individuelclient client 
                WITH g.id = client.MembreGroupe

                WHERE client.dateadhesion >= :du AND client.dateadhesion <= :au 
                AND client.garant = 0";
                $statement = $this->getEntityManager()
                ->createQuery($query)
                ->setParameter(':du',$date1)
                ->setParameter(':au',$date2)
                ->execute();

            return $statement;
      }

     public function findByGroupId(){

      $query = 'SELECT MAX(groupe.id) FROM App\Entity\Groupe groupe';
      $statement = $this->getEntityManager()->createQuery($query)->execute();

      return $statement;
     }

     ///Nombre client par groupe
     public function findByNumberClienByGroupe(){
        $query = 'SELECT COUNT(client.id) nombre_par_membre, g.codegroupe,g.nomGroupe,g.email,g.dateInscription FROM App\Entity\Groupe g
                LEFT JOIN App\Entity\Individuelclient client WITH g.id = client.MembreGroupe
             GROUP BY g.id';
        $statement = $this->getEntityManager()->createQuery($query)->execute();
        
        return $statement;
     }
     public function filtreByOneDate($date){

        $query = "SELECT  
                  g.codegroupe,
                 client.codeclient,
                  client.dateadhesion , 
                  client.nom_client ,
                  client.prenom_client,
                  client.garant,
                  g.email ,
                  g.nomGroupe ,
                  g.email
                  FROM App\Entity\Groupe g
                  LEFT JOIN App\Entity\Individuelclient client 
                  WITH g.id = client.MembreGroupe
                  WHERE 
                  client.dateadhesion <=  :one_date
                  AND client.garant = 0
                   ORDER BY client.dateadhesion ASC
                  ";
                $statement = $this->getEntityManager()->createQuery($query)
                ->setParameter(':one_date',$date)
                ->execute();

            return $statement;
      }

    //C**************Code groupe ************************************/
    public function code_groupe(){
        $query = " SELECT groupe.codegroupe code
        FROM App\Entity\Groupe groupe ";
        
        $stmt = $this->getEntityManager()->createQuery($query)->getResult();

        return $stmt;
    }
    
    public function code_groupe_api($code){
      $query = " SELECT groupe.codegroupe code,groupe.nomGroupe nom, groupe.email
      FROM App\Entity\Groupe groupe 
      WHERE groupe.codegroupe = '$code'";
      
      $stmt = $this->getEntityManager()->createQuery($query)->getResult();

      return $stmt;
    }

  /********************************************************************************* */

  /******************Liste de membre dans un groupe */
  public function membreGroupe($id){
    $query = " SELECT groupe.codegroupe code,groupe.nomGroupe nom, groupe.email,client.nom_client,client.prenom_client, client.codeclient,client.TitreGroupe 
    FROM App\Entity\Groupe groupe
    LEFT JOIN App\Entity\Individuelclient client
     WITH groupe.id = client.MembreGroupe 
    WHERE groupe.id = '$id'";
    
    $stmt = $this->getEntityManager()->createQuery($query)->getResult();

    return $stmt;
  }
  

  /**********************Pr */
  public function api_compte_epargne_groupe()
  {
    $query = " SELECT
      ce.codegroupeepargne code
    FROM  App\Entity\CompteEpargne ce
    WHERE ce.codegroupeepargne IS NOT NULL ";
    
    $stmt = $this->getEntityManager()->createQuery($query)->getResult();

    return $stmt;
  }

  public function api_compte_epargne_groupe_code($code)
  {

    $query = " SELECT
      ce.codegroupeepargne code ,
      groupe.nomGroupe nom,
      groupe.email,
      groupe.codegroupe

    FROM  App\Entity\CompteEpargne ce
    INNER JOIN  App\Entity\Groupe groupe
    WITH ce.codegroupe = groupe.codegroupe
    WHERE ce.codegroupeepargne = '$code'
     ";
    
    $stmt = $this->getEntityManager()->createQuery($query)->getResult();

    return $stmt;
  }
  
  /**
   * Fonction pour creer un compte epargne groupe
   *
   * @param [type] $id
   * @return void
   */
  public function findGroupByIdOpenAccount($id)
  {
    $query = " SELECT
      gr.nomGroupe,
      gr.email,
      gr.codegroupe,
      gr.numeroMobile
    FROM  App\Entity\Groupe gr
    WHERE gr.id = '$id'";
    
    $stmt = $this->getEntityManager()->createQuery($query)->getResult();

    return $stmt;
  }
}
