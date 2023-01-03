<?php

namespace App\Repository;

use App\Entity\CompteEpargne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompteEpargne>
 *
 * @method CompteEpargne|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompteEpargne|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompteEpargne[]    findAll()
 * @method CompteEpargne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteEpargneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompteEpargne::class);
    }

    public function add(CompteEpargne $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        //dd($entity);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   
    public function remove(CompteEpargne $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    // Filtre entre deux date des comptes epargnes pour les individuels

   public function FiltreDateIndividuelClient($date1,$date2): array
   {
        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'SELECT
            c
            FROM
            App\Entity\CompteEpargne c
            WHERE
            c.datedebut
            BETWEEN :date1 AND :date2 AND c.typeClient=\'INDIVIDUEL\'
            '
        )
        ->setParameter('date1',$date1)
        ->setParameter('date1',$date2)
        ;
        return $query->getResult();
   }

//    solde
//    public function Solde($id)
//    {
//       $entityManager=$this->getEntityManager();
//       $query=$entityManager->createQuery(
//         'SELECT
//          c.id,
//          c.solde,
//          t.Description,
//          t.Montant
//          FROM 
//          App\Entity\CompteEpargne c
//          INNER JOIN
//          App\Entity\Transaction t
//          WHERE
//          t.NumeroCompteEpargne = c.id AND
//          c.id = :id '
//         )->setParameter('id',$id);
//         return $query->getResult();
//    }

   //Entre deux date
    public function CompteEpargne($date1,$date2)
    {

        $query = "SELECT 
                c.datedebut,
                c.id as idepc,
                c.typeClient,
                c.codeepargne,
                -- i.id AS codecl,
                i.nom_client as nom,
                i.prenom_client as prenom,
                -- (pe.id) AS codeprod,
                 (pe.nomproduit) AS nomprod
                -- (te.id) as codeep
            FROM App\Entity\CompteEpargne c 
            INNER JOIN App\Entity\Individuelclient i
            WITH c.codeep = i.codeclient
            INNER JOIN App\Entity\ProduitEpargne pe
            WITH c.produit = pe.id
            WHERE c.datedebut BETWEEN :date1 AND :date2
           ";


           $statement = $this->getEntityManager()->createQuery($query)->setParameter('date1',$date1)->setParameter('date2',$date2)->execute();
   
           return $statement;
    }

       //Dans une date
       public function CompteEpargne_one_date($date)
       {
           $query = "SELECT 
                   c.datedebut,
                   c.id as idepc,
                   c.typeClient,
                   c.codeepargne,
                   -- i.id AS codecl,
                   i.nom_client as nom,
                   i.prenom_client as prenom,
                   -- (pe.id) AS codeprod,
                    (pe.nomproduit) AS nomprod
                   -- (te.id) as codeep
               FROM App\Entity\CompteEpargne c 
               INNER JOIN App\Entity\Individuelclient i
               WITH c.codeep = i.codeclient
               INNER JOIN App\Entity\ProduitEpargne pe
               WITH c.produit = pe.id
               WHERE c.datedebut <= :date1
              ";
              $statement = $this->getEntityManager()->createQuery($query)->setParameter('date1',$date)->execute();
      
              return $statement;
       }


 

// Cette fonction permet d'avoir les rapports de tous les solde du clients
   public function rapportsolde()
   {
    $entityManager=$this->getEntityManager();
    $query=$entityManager->createQuery(
        'SELECT DISTINCT
        -- compte epargne
        c.id,
        c.codeepargne,
        c.codeep,
        -- individuel client
        (i.id) as codeclient,
        (i.nom_client) AS nomclient,
        (i.prenom_client) AS prenomclient,
        -- produit
        (p.id) as codeproduit,
        (p.nomproduit) as nomproduit,
        -- type
        (te.id) as codetypeepargne,
        -- solde
        (tr.solde) as soldes,
        tr.DateTransaction
        FROM 
        App\Entity\CompteEpargne c
        INNER JOIN
        App\Entity\Individuelclient i,
        App\Entity\ProduitEpargne p,
        App\Entity\TypeEpargne te,
        App\Entity\Transaction tr
        WHERE c.codeep = i.codeclient AND
        c.produit = p.id AND
        p.typeEpargne = te.id AND
        tr.codeepargneclient = c.codeepargne
        GROUP BY tr.id
        '
        )
        ->setMaxResults(0);

         return $query->getResult();
  }
   
    // Liste des groupes existants
    public function ListeGroupe(){
        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'SELECT 
            -- compte epargne
            c.datedebut,
            c.id as codeep,
            c.codegroupeepargne,
            -- compte groupe
            g.nomGroupe,
            g.id as codegrp,
            -- produit epargne
            p.id as codeproduit,
            p.nomproduit as nomprod,
            -- type epargne
            te.id as typeepargne,
            te.NomTypeEp as typeEpargne
            FROM
                App\Entity\CompteEpargne c
            INNER JOIN
                App\Entity\Groupe g
            INNER JOIN
                App\Entity\ProduitEpargne p
            INNER JOIN
                App\Entity\TypeEpargne te
            WITH
                c.codegroupe = g.codegroupe AND
                c.produit = p.id AND
                p.typeEpargne = te.id
            '
        );

        return $query->getResult();
    }

    // Filtre entre deux date pour les compte epargne groupe

    public function FiltreGroupeEpargne($date1,$date2):array
    {
        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'SELECT 
            -- compte epargne
            c.datedebut,
            c.id as codeep,
            c.codegroupeepargne,
            -- compte groupe
            g.nomGroupe,
            g.id as codegrp,
            -- produit epargne
            p.id as codeproduit,
            p.nomproduit as nomprod,
            -- type epargne
            te.id as typeepargne,
            te.NomTypeEp as typeEpargne
            FROM
                App\Entity\CompteEpargne c
            INNER JOIN
                App\Entity\Groupe g
            INNER JOIN
                App\Entity\ProduitEpargne p
            INNER JOIN
                App\Entity\TypeEpargne te
            WITH
                c.codegroupe = g.codegroupe AND
                c.produit = p.id AND
                p.typeEpargne = te.id
            WHERE c.datedebut BETWEEN :date1 AND :date2
            GROUP BY c.codegroupeepargne
            '
        )
        ->setParameter('date1',$date1)
        ->setParameter('date2',$date2)
        ;

        return $query->getResult();
    }

    // Filtre entre deux date transaction
    public function FiltreRapportSolde($Du,$Au=null){
        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'SELECT DISTINCT
            -- compte epargne
            c.id,
            tr.Description,
            c.codeepargne,
            c.codeep,
            -- individuel client
            (i.id) as codeclient,
            (i.nom_client) AS nomclient,
            (i.prenom_client) AS prenomclient,
            -- produit
            (p.id) as codeproduit,
            (p.nomproduit) as nomproduit,
            -- type
            (te.id) as codetypeepargne,
            -- solde
            (tr.solde) as soldes,
            tr.DateTransaction
            FROM 
            App\Entity\CompteEpargne c
            INNER JOIN
            App\Entity\Individuelclient i,
            App\Entity\ProduitEpargne p,
            App\Entity\TypeEpargne te,
            App\Entity\Transaction tr
            WHERE c.codeep = i.codeclient AND
            c.produit = p.id AND
            p.typeEpargne = te.id AND
            tr.codeepargneclient = c.codeepargne
            AND tr.DateTransaction BETWEEN :Du AND :Au
            GROUP BY tr.id
            ')
            ->setParameter(':Du',$Du)
            ->setParameter(':Au',$Au)
            ;
    
             return $query->getResult();
    }

    // Filtre date arrete
        // Filtre entre deux date transaction
        public function FiltreSoldeArrete($Du){
            $entityManager=$this->getEntityManager();
            $query=$entityManager->createQuery(
                'SELECT DISTINCT
                -- compte epargne
                c.id,
                --Description --
                tr.Description,

                c.codeepargne,
                c.codeep,
                -- individuel client
                (i.id) as codeclient,
                (i.nom_client) AS nomclient,
                (i.prenom_client) AS prenomclient,
                -- produit
                (p.id) as codeproduit,
                (p.nomproduit) as nomproduit,
                -- type
                (te.id) as codetypeepargne,
                -- solde
                (tr.solde) as soldes,
                tr.DateTransaction
                FROM 
                App\Entity\CompteEpargne c
                INNER JOIN
                App\Entity\Individuelclient i,
                App\Entity\ProduitEpargne p,
                App\Entity\TypeEpargne te,
                App\Entity\Transaction tr
                WHERE c.codeep = i.codeclient AND
                c.produit = p.id AND
                p.typeEpargne = te.id AND
                tr.codeepargneclient = c.codeepargne
                AND tr.DateTransaction <= :Du
                GROUP BY tr.id
                ')
                ->setParameter(':Du',$Du)
                ;
        
                 return $query->getResult();
        }
    

     // Filtre rapport transaction du jour
     
     public function RapportTransactionDuJour($Du){
        return $this->createQueryBuilder('c')
                    ->innerJoin('c.transactions','t')
                    ->where('c.transactions = t.NumeroCompteEpargne')
                    ->andWhere('t.DateTransaction = :Du')
                    ->setParameter(':Du',$Du)
                    ->getQuery()
                    ->getResult()
                    ;
    }

  
    // Cette fonction est pour les client epargne d'aujjourd'hui
    public function compteClientCourant($code){
        
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
        "SELECT DISTINCT
        ---code epargne
        ce.codeepargne,
        ce.codeep,
        -- produit
         p.nomproduit,
        -- -- Compte epargne
        ce.datedebut,
        ce.id,
           
        i.nom_client,
        i.codeclient,
        i.prenom_client,
        
        
         t.solde
        FROM
        App\Entity\CompteEpargne ce
        LEFT JOIN
         App\Entity\Transaction t
         WITH t.codeepargneclient = ce.codeepargne
         INNER JOIN 
         App\Entity\ProduitEpargne p
         WITH ce.produit=p.id

        INNER JOIN
        App\Entity\Individuelclient i
        WITH ce.codeep = i.codeclient
        WHERE ce.codeep = '$code'
        ORDER BY ce.datedebut DESC
      --  AND t.id = (SELECT MAX(tr.id) FROM App\Entity\Transaction tr INNER JOIN App\Entity\CompteEpargne c  WITH tr.codeepargneclient = c.codeepargne  WHERE ce.codeep = '$code' )
        "
        );
        return $query->getResult();

    }
    // **********************************************
    // **********************************************
    // **********************************************

    public function Allcompteep(){
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
        'SELECT
            ce.datedebut,
            ce.codegroupe,
            ce.codegroupeepargne
        FROM
        App\Entity\CompteEpargne ce
        ');

        return  $query->getResult();
    }

    public function filtre($date1,$date2){
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
        'SELECT
            ce.datedebut,
            ce.codegroupe,
            ce.codegroupeepargne
        FROM
        App\Entity\CompteEpargne ce
        WHERE ce.datedebut BETWEEN :date1 AND :date2
        ')
        ->setParameter(':date1',$date1)
        ->setParameter(':date2',$date2)
        ;

        return  $query->getResult();
    }


        // cette fonction est pour le rapport des compte epargne
        public function rapport_compte_epargne()
        {
            $entityManager =$this->getEntityManager();
    
            $query=$entityManager->createQuery(
                'SELECT 
                -- COMPTE EPARGNE
                ce.datedebut,
                ce.codeepargne,
                -- -- INDIVIDUEL CLIENT
                i.nom_client,
                i.prenom_client,
                -- -- PRODUIT EPARGNE
                p.nomproduit
                -- -- TYPE EPARGNE
                
                FROM
                App\Entity\CompteEpargne ce
                INNER JOIN
                App\Entity\Individuelclient i
                INNER JOIN
                App\Entity\ProduitEpargne p
                WHERE
                ce.codeep = i.codeclient
                AND
                ce.produit = p.id
                '
            );
    
            return $query->getResult();
    
    
        }
            // cette fonction est pour trier les compte epargne
            public function rapport_compte_epargne_triedate($datedebut,$datefin)
            {
                $entityManager =$this->getEntityManager();
        
                $query=$entityManager->createQuery(
                    'SELECT 
                -- COMPTE EPARGNE
                ce.datedebut,
                ce.codeepargne,
                -- -- INDIVIDUEL CLIENT
                i.nom_client,
                i.prenom_client,
                -- -- PRODUIT EPARGNE
                p.nomproduit
                FROM
                App\Entity\CompteEpargne ce
                INNER JOIN
                App\Entity\Individuelclient i
                INNER JOIN
                App\Entity\ProduitEpargne p
                WHERE
                ce.codeep = i.codeclient
                AND
                ce.produit = p.id
                AND
                ce.datedebut BETWEEN :datedebut AND :datefin
                    '
                )
                ->setParameter(':datedebut',$datedebut)
                ->setParameter(':datefin',$datefin)
                ;
        
                return $query->getResult();
        
        
            }
    
             // cette fonction est pour la date arrete du rapport compte epargne
             public function rapport_compte_epargne_arrete($datearrete)
             {
                 $entityManager =$this->getEntityManager();
         
                 $query=$entityManager->createQuery(
                     'SELECT 
                 -- COMPTE EPARGNE
                 ce.datedebut,
                 ce.codeepargne,
                 -- -- INDIVIDUEL CLIENT
                 i.nom_client,
                 i.prenom_client,
                 -- -- PRODUIT EPARGNE
                 p.nomproduit
                 -- -- TYPE EPARGNE
                 -- te
                 FROM
                 App\Entity\CompteEpargne ce
                 INNER JOIN
                 App\Entity\Individuelclient i
                 INNER JOIN
                 App\Entity\ProduitEpargne p
                 WHERE
                 ce.codeep = i.codeclient
                 AND
                 ce.produit = p.id
                 AND
                 ce.datedebut <= :datearrete 
                 -- AND
                 -- ce.datedebut <=:datearrete
                     '
                 )
                 ->setParameter(':datearrete',$datearrete)
                 ;
         
                 return $query->getResult();
         
         
             }


    /***************************Information du client qui a un compte epargne */

    public function clientCompteEpargne($id)
    {
        $entityManager =$this->getEntityManager();

        $query=$entityManager->createQuery(
            "SELECT 
        -- COMPTE EPARGNE
        i.photo,
        i.nom_client,
        i.prenom_client,
        i.cin,
        i.numero_mobile telephone,
        i.profession ,
        i.adressephysique adresse,
        i.nb_personne_charge charge,
        ce.codeepargne code_epargne,
        -- -- PRODUIT EPARGNE
        p.nomproduit,
        -- -- TYPE EPARGNE
        ------Commune --------------
        c.NomCommune commune,
        c.CodeCommune code_commune
        -- te
        FROM
        App\Entity\CompteEpargne ce
        INNER JOIN
        App\Entity\Individuelclient i
        WITH ce.codeep = i.codeclient
        INNER JOIN
        App\Entity\Commune c
        WITH c.NomCommune = i.commune
        INNER JOIN
        App\Entity\ProduitEpargne p
        WITH
        ce.produit = p.id
        WHERE
        ce.id = $id "
        );

        return $query->getResult();
    }

    /**********************************Compte epargne existant */

    public function compteEpargneExist($code){
        $query = " SELECT 
        g.codegroupe,
        g.nomGroupe nom,
        pe.nomproduit,
        ce.datedebut ,
        ce.id,
        ce.codegroupeepargne,
        t.solde
        FROM App\Entity\CompteEpargne ce 
        LEFT JOIN
        App\Entity\Transaction t
        WITH t.codeepargneclient = ce.codeepargne
        INNER JOIN
        App\Entity\ProduitEpargne pe
        with ce.produit = pe.id
        INNER JOIN 
        App\Entity\Groupe g
        WITH ce.codegroupe = g.codegroupe
        WHERE ce.codegroupe = '$code' 
        --AND t.id = (SELECT MAX(tr.id) FROM App\Entity\CompteEpargne c RIGHT JOIN App\Entity\Transaction tr  WITH tr.codeepargnegroupe = c.codegroupeepargne  WHERE ce.codeep = '$code' )
       ";
        
        $stmt = $this->getEntityManager()->createQuery($query)->getResult();
  
        return $stmt;
    }


    //   api code epargne
      public function codeCompteEpargne()
      {
        
        $query = " SELECT DISTINCT(ce.codeepargne) code  FROM App\Entity\CompteEpargne ce WHERE ce.codeepargne != 'null'";
        
        $stmt = $this->getEntityManager()->createQuery($query)->getResult();
  
        return $stmt;

      }


      public function codeCompteEpargneInfo($code)
      {
        
        $query = " SELECT
            DISTINCT
            (ce.codeepargne) code ,
            ce.codeep client_code, 
            i.nom_client,
            i.prenom_client,
            pe.nomproduit,
            g.codegroupe,
            g.nomGroupe,
            g.email
         FROM
         App\Entity\CompteEpargne ce
         LEFT JOIN App\Entity\Groupe g

         with 
         ce.codeep = g.codegroupe

         LEFT JOIN   App\Entity\Individuelclient i
         with ce.codeep = i.codeclient

         INNER JOIN
         App\Entity\ProduitEpargne pe
         with  ce.produit = pe.id


          WHERE ce.codeepargne = '$code'";
        
        $stmt = $this->getEntityManager()->createQuery($query)->getResult();
  
        return $stmt;

      }

    public function findyGroupeById($id){
        $query = " SELECT DISTINCT(ce.id),
        ce.codegroupeepargne,
        g.nomGroupe,
        g.dateInscription,
        g.numeroMobile,
        g.email,
        pe.nomproduit,
        t.solde

        FROM App\Entity\CompteEpargne ce

        INNER JOIN 
        App\Entity\Groupe g
        WITH ce.codegroupe = g.codegroupe

        INNER JOIN
        App\Entity\ProduitEpargne pe
        with ce.produit = pe.id

        LEFT JOIN
        App\Entity\Transaction t
        WITH t.codeepargneclient = ce.codeepargne

        WHERE ce.id = '$id'";
       
        $stmt = $this->getEntityManager()->createQuery($query)->getResult();
    
        return $stmt;
    }

    
    public function compteGroupeExiste(){
        
    }
    
}
