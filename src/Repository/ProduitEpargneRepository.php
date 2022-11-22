<?php

namespace App\Repository;

use App\Entity\ProduitEpargne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\GroupBy;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProduitEpargne>
 *
 * @method ProduitEpargne|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProduitEpargne|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProduitEpargne[]    findAll()
 * @method ProduitEpargne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitEpargneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProduitEpargne::class);
    }

    public function add(ProduitEpargne $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProduitEpargne $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   public function GetType()
   {
       return $this->createQueryBuilder('p')
           ->leftJoin('p.typeEpargne','t')
           ->where('t.id = p.typeEpargne')
        //    ->andWhere('p.id')
        //    ->setParameter('val', $value)
        //    ->orderBy('p.id', 'ASC')
        //    ->setMaxResults(10)
            ->groupBy('p.id')
           ->getQuery()
           ->getResult()
       ;
   }

   public function Produit()
   {
        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'SELECT
             p.nomproduit,
             p.isdesactive,
             p.id,
             (t.NomTypeEp) AS typeep,
             t.id AS codetype
             FROM
             App\Entity\ProduitEpargne p
             INNER JOIN
             App\Entity\TypeEpargne t 
             WHERE
             p.typeEpargne=t.id
              ');

              return $query->getResult();
    }

    public function findByApiProduit($id)
    {
        $query = " SELECT p.nomproduit,p.id Produit_id,(t.NomTypeEp) AS typeep, t.id AS TypeProd 
        FROM App\Entity\ProduitEpargne p 
        INNER JOIN App\Entity\TypeEpargne t 
        WITH t.id = p.typeEpargne 
        WHERE p.id = $id";
        
        $stmt = $this->getEntityManager()->createQuery($query)->getResult();

        return $stmt;
    }

    //Fonction api code client 
    public function code_client_api($code)
    {
        $query = " SELECT client.codeclient ,client.nom_client nom, client.prenom_client prenom 
        FROM App\Entity\Individuelclient client
        WHERE client.codeclient = '$code'";
        
        $stmt = $this->getEntityManager()->createQuery($query)->getResult();

        return $stmt;
    }

    //Code client
    public function code_client(){
        $query = " SELECT client.codeclient code
        FROM App\Entity\Individuelclient client ";
        
        $stmt = $this->getEntityManager()->createQuery($query)->getResult();

        return $stmt;
    }

    

    //Code epargne
    public function code_epargne(){
        $query = " SELECT DISTINCT epargne.codeepargneclient code
        FROM App\Entity\Transaction epargne ";
        
        $stmt = $this->getEntityManager()->createQuery($query)->getResult();

        return $stmt;
    }

}
