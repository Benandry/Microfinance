<?php

namespace App\Repository;

use App\Entity\Individuelclient;
use App\Entity\Agence;
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

    // public function profil(int $id):array
    // {
    //     $entityManager = $this->getEntityManager();

    //     $query = $entityManager->createQuery(
    //         'SELECT i,a
    //         FROM App\Entity\Individuelclient i INNER JOIN App\Entity\Agence a'
    //     )->setParameter('id',$id);

    //     return $query->getResult();
    // }


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

   public function Client()
   {
       $entityManager=$this->getEntityManager();

       $query=$entityManager->createQuery(
           'SELECT
            i 
            FROM
            App\Entity\Individuelclient i
            ORDER BY i.id DESC'
       )
       ->setMaxResults(5);
       return $query->getResult();
   }

    
   //    Cette fonction permet de trier les rapoort client entre deux date
    public function trierRapportClient ($date1=null,$date2=null)
    {
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT i
             FROM App\Entity\Individuelclient i
              WHERE i.date_inscription
               BETWEEN :date1 AND :date2')
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
              WHERE i.date_inscription <=  :date2 ORDER BY i.date_inscription ASC')
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
            'SELECT i
             FROM App\Entity\Individuelclient i
              WHERE i.date_inscription <= :date1')
            ->setParameter('date1',$date);

            return $query->getResult();   
    }
}
