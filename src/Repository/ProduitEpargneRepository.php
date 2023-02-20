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
        $query = 'SELECT
        p.nomproduit,
        p.id,
        p.abbreviation
        FROM
        App\Entity\ProduitEpargne p
         ';
        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery($query);

              return $query->getResult();
    }

    public function findByApiProduit($id)
    {
        $query = " SELECT
             p.nomproduit,
             p.id Produit_id
        FROM App\Entity\ProduitEpargne p 
        WHERE p.id = $id";
        
        $stmt = $this->getEntityManager()->createQuery($query)->getResult();

        return $stmt;
    }

    //Fonction api code client pour ouvrir un compte epargne
    public function code_client_api($id)
    {
        $query = " SELECT client.codeclient ,client.nom_client nom, client.prenom_client prenom 
        FROM App\Entity\Individuelclient client
        WHERE client.id = '$id'";
        
        $stmt = $this->getEntityManager()->createQuery($query)->getResult();

        return $stmt;
    }

    //Code client
    public function code_client(){
        $query = " SELECT 
            client.codeclient code,
            client.nom_client,
            cli.prenom_client
        FROM
             App\Entity\Individuelclient client ";
        
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

    public function findByProduitDepot($code)
    {
        $query = " SELECT p
        FROM App\Entity\ProduitEpargne p 
        INNER JOIN App\Entity\CompteEpargne ce
        WITH p.id = ce.produit 
         WHERE ce.codeepargne = '$code'
        ";
        
        $stmt = $this->getEntityManager()->createQuery($query)->getResult();

        return $stmt;
    }

    /**
     * Fonction qui relier les produit epargne et configuration epargne
     *
     * @param [type] $id
     * @return void
     */
    public function findByConfigurationProduitEpargne($id)
    {
        $query = " SELECT
             p.nomproduit,
             p.id Produit_id,
             conf.IsNegatif,
             conf.nbMinRet jour_minimum_retrait,
             conf.NbrJrMaxDep jour_maximum_depot,
             conf.ageMinCpt age_minimum_ouvrir_compte,
             conf.commissionTransf commission_de_transaction,
             conf.fraisFermCpt Frais_compte_tenu,
             conf.soldeouvert solde_ouverture,
            --  plan.Libelle compte_debit,
            --  plan.Libelle compte_credit,
             devise.devise
        FROM App\Entity\ProduitEpargne p 

        INNER JOIN 
        App\Entity\ConfigEp conf
        WITH conf.produitEpargne = p.id

        -- INNER JOIN 
        -- App\Entity\PlanComptable plan
        -- WITH  conf.compteCrediteE = plan.id

        INNER JOIN 
        App\Entity\Devise devise
        WITH conf.deviseutiliser = devise.id

        WHERE p.id = $id
        ";
        
        $stmt = $this->getEntityManager()->createQuery($query)->getResult();

        return $stmt;
    }
}
