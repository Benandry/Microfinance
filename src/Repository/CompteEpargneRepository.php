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

        $query = 'SELECT 
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
           ';


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
         -- groupe
         g.nomGroupe,
        -- -- produit
        (p.id) as codeproduit,
        (p.nomproduit) as nomproduit,

        -- -- solde
        SUM(tr.Montant) as soldes,
        tr.DateTransaction,
        tr.Description,
        tr.typeClient
        FROM 
        App\Entity\CompteEpargne c

        LEFT JOIN
        App\Entity\Individuelclient i
        WITH
        c.codeep = i.codeclient

        LEFT JOIN
        App\Entity\Groupe g
        WITH
        c.codeep = g.codegroupe

        INNER JOIN
        App\Entity\ProduitEpargne p
        With
        c.produit = p.id

        INNER JOIN
        App\Entity\Transaction tr
        WITH
        tr.codeepargneclient = c.codeepargne

        GROUP BY tr.codeepargneclient
        '
        );

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
                    c.codeepargne,
                    c.codeep,
                    -- individuel client
                    (i.id) as codeclient,
                    (i.nom_client) AS nomclient,
                    (i.prenom_client) AS prenomclient,
                    -- groupe
                    g.nomGroupe,
                    -- -- produit
                    (p.id) as codeproduit,
                    (p.nomproduit) as nomproduit,
                    -- -- type
                    (te.id) as codetypeepargne,
                    -- -- solde
                    SUM(tr.Montant) as soldes,
                    tr.DateTransaction,
                    tr.Description,
                    tr.typeClient
                    FROM 
                    App\Entity\CompteEpargne c
                    LEFT JOIN
                    App\Entity\Individuelclient i
                    WITH
                    c.codeep = i.codeclient

                    LEFT JOIN
                    App\Entity\Groupe g
                    WITH
                    c.codeep = g.codegroupe

                    INNER JOIN
                    App\Entity\ProduitEpargne p
                    INNER JOIN
                    App\Entity\TypeEpargne te
                    INNER JOIN
                    App\Entity\Transaction tr
                    WITH
                    c.produit = p.id
                    AND
                    p.typeEpargne = te.id
                    AND
                    tr.codeepargneclient = c.codeepargne
                    AND tr.DateTransaction BETWEEN :Du AND :Au
                    GROUP BY tr.codeepargneclient
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
                    ce.datedebut,
                    ce.codeepargne,
                    ce.typeClient,
                    -- INDIVIDUEL CLIENT
                    i.nom_client nomclient ,
                    i.prenom_client prenomclient ,
                    -- GROUPE
                    g.nomGroupe,
                    -- PRODUIT EPARGNE
                    p.nomproduit,
                    -- TYPE EPARGNE
                    SUM(tr.Montant) soldes,
                    tr.DateTransaction 

                    FROM 
                    App\Entity\CompteEpargne ce
                    LEFT JOIN
                    App\Entity\Individuelclient i
                    WITH
                    ce.codeep = i.codeclient

                    LEFT JOIN
                    App\Entity\Groupe g
                    WITH
                    ce.codeep = g.codegroupe

                    INNER JOIN
                    App\Entity\ProduitEpargne p
                    WITH
                    ce.produit = p.id

                    LEFT JOIN
                    App\Entity\Transaction tr
                    with tr.codeepargneclient = ce.codeepargne
                    WHERE
                    ce.datedebut <= :Du 

                    GROUP BY ce.codeepargne

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
        
        
         SUM(t.Montant) solde
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
        GROUP BY ce.codeepargne
        ORDER BY ce.id DESC
      --  AND t.id = (SELECT MAX(tr.id) FROM App\Entity\Transaction tr INNER JOIN App\Entity\CompteEpargne c  WITH tr.codeepargneclient = c.codeepargne  WHERE ce.codeep = '$code' )
        "
        );
        return $query->getResult();

    }

        /**********************************Compte epargne existant */

        public function compteEpargneExist($code){
            $query = " SELECT DISTINCT
            g.codegroupe,
            g.nomGroupe nom,
            pe.nomproduit,
            ce.datedebut ,
            ce.id,
            ce.codeep,
            ce.codeepargne,
            SUM(t.Montant) solde

            FROM App\Entity\CompteEpargne ce 
            LEFT JOIN
            App\Entity\Transaction t
            WITH t.codeepargneclient = ce.codeepargne

            INNER JOIN
            App\Entity\ProduitEpargne pe
            with ce.produit = pe.id

            INNER JOIN 
            App\Entity\Groupe g
            WITH ce.codeep = g.codegroupe
            WHERE ce.codeep = '$code'
            GROUP BY ce.codeepargne
            
            ORDER BY ce.datedebut DESC
            ";
            
            $stmt = $this->getEntityManager()->createQuery($query)->getResult();
      
            return $stmt;
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
                ce.typeClient,
                -- INDIVIDUEL CLIENT
                i.nom_client,
                i.prenom_client,
                -- GROUPE
                g.nomGroupe,
                -- PRODUIT EPARGNE
                p.nomproduit
                -- TYPE EPARGNE
                
                FROM
                App\Entity\CompteEpargne ce
                LEFT JOIN
                App\Entity\Individuelclient i
                WITH
                ce.codeep = i.codeclient

                LEFT JOIN
                App\Entity\Groupe g
                WITH
                ce.codeep = g.codegroupe

                INNER JOIN
                App\Entity\ProduitEpargne p
                WITH
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
                ce.typeClient,
                -- INDIVIDUEL CLIENT
                i.nom_client,
                i.prenom_client,
                -- GROUPE
                g.nomGroupe,
                -- PRODUIT EPARGNE
                p.nomproduit,
                SUM(tr.Montant) solde
                
                FROM
                App\Entity\CompteEpargne ce
                LEFT JOIN
                App\Entity\Individuelclient i
                WITH
                ce.codeep = i.codeclient

                LEFT JOIN
                App\Entity\Groupe g
                WITH
                ce.codeep = g.codegroupe

                INNER JOIN
                App\Entity\ProduitEpargne p
                WITH
                ce.produit = p.id

                LEFT JOIN
                App\Entity\Transaction tr
                with tr.codeepargneclient = ce.codeepargne
                WHERE
                ce.datedebut BETWEEN :datedebut AND :datefin 

                 GROUP BY ce.codeepargne
               
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
                ce.typeClient,
                -- INDIVIDUEL CLIENT
                i.nom_client,
                i.prenom_client,
                -- GROUPE
                g.nomGroupe,
                -- PRODUIT EPARGNE
                p.nomproduit,
                -- TYPE EPARGNE
                SUM(tr.Montant) solde
                FROM
                App\Entity\CompteEpargne ce
                LEFT JOIN
                App\Entity\Individuelclient i
                WITH
                ce.codeep = i.codeclient

                LEFT JOIN
                App\Entity\Groupe g
                WITH
                ce.codeep = g.codegroupe

                INNER JOIN
                App\Entity\ProduitEpargne p
                WITH
                ce.produit = p.id

                LEFT JOIN
                App\Entity\Transaction tr
                with tr.codeepargneclient = ce.codeepargne
                WHERE
                 ce.datedebut <= :datearrete 

                 GROUP BY ce.codeepargne '
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
        i.numeroMobile telephone,
        i.profession ,
        i.adressephysique adresse,
        i.nb_personne_charge charge,
        ce.codeepargne code_epargne,
        ce.id,
        ce.datedebut,
        i.codeclient,
        i.id idcli,
        -- -- PRODUIT EPARGNE
        p.nomproduit,
        p.abbreviation abreviation,
        -- -- TYPE EPARGNE
        ----Solde --------------
        SUM(tr.Montant) solde
        -- te
        FROM
        App\Entity\CompteEpargne ce
        INNER JOIN

        App\Entity\Individuelclient i
        WITH ce.codeep = i.codeclient

        LEFT JOIN
        App\Entity\Transaction tr
        with tr.codeepargneclient = ce.codeepargne
        INNER JOIN
        App\Entity\ProduitEpargne p
        WITH
        ce.produit = p.id
        WHERE
        ce.id = $id 
        GROUP BY ce.codeepargne"
        );

        return $query->getResult();
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
        $query = " SELECT 
        g.id id_groupe,
        ce.id,
        ce.datedebut datecreation,
        ce.codeepargne,
        g.codegroupe,
        g.nomGroupe,
        g.dateInscription,
        g.numeroMobile,
        g.email,
        pe.nomproduit,
        pe.abbreviation,
        SUM(t.Montant) solde

        FROM App\Entity\CompteEpargne ce

        INNER JOIN 
        App\Entity\Groupe g
        WITH ce.codeep = g.codegroupe

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

    /**
     * Cette foncion permet de get l'iformatio du client pour ouvrir un compte epargne
     *
     * @param int $id id du client
     * @return void
     */
    public function getInfoClient($id){
        $query = " SELECT 
        i.id,
        i.nom_client,
        i.prenom_client,
        i.codeclient,
        i.date_naissance
        FROM App\Entity\Individuelclient i
        WHERE i.id = $id";
       
        $stmt = $this->getEntityManager()->createQuery($query)->getResult();
    
        return $stmt;
    }

    public function compteEpargneVerify($compte_epargne){
        $query = " SELECT 
        ce.codeepargne
        FROM App\Entity\CompteEpargne ce 
        WHERE  ce.codeepargne = '$compte_epargne'";
       
        $stmt = $this->getEntityManager()->createQuery($query)->getResult();
    
        return $stmt;
    }

    /**
     * Cette fonction permet de recuperer les information du groupe pour ouvrir un compte epargne de groupe
     *
     * @param int $id
     * @return void
     */
    public function getInfoGroupe($id){
        $query = " SELECT 
        g.id,
        g.nomGroupe,
        g.email,
        g.codegroupe
        FROM App\Entity\Groupe g
        WHERE g.id = $id";
       
        $stmt = $this->getEntityManager()->createQuery($query)->getResult();
    
        return $stmt;
    }

    public function findCompteEpargneByClient($individuel)
    {
        $query = "SELECT 
        --Conmpte epargne  --
          ce.datedebut,
          ce.codeepargne,
          ce.typeClient,
          -- Produit epargne --
          pe.nomproduit,
          -- Solde  --
          SUM(tr.Montant) solde,

          -- individuel client --
          i.nom_client,
          i.prenom_client,
          -----------------------

          ----Groupe ----
          g.nomGroupe,
          g.email
         FROM App\Entity\CompteEpargne ce

         LEFT JOIN App\Entity\Individuelclient i
         with ce.codeep = i.codeclient

         LEFT JOIN App\Entity\Groupe g
         with ce.codeep = g.codegroupe

         INNER JOIN App\Entity\ProduitEpargne pe
         with pe.id = ce.produit

         LEFT JOIN App\Entity\Transaction tr
         with ce.codeepargne = tr.codeepargneclient 

         WHERE ce.codeep ='$individuel'
         ";
 
         $statement = $this->getEntityManager()->createQuery($query)->execute();        
         return $statement;
    }

/**
 * Fonctio utiliser pour filtrer les compte epargne par client]
 *
 * @param [int] $id_agence
 * @return void
 */
    public function findCompteEpargneByAgence($id_agence)
    {
        $query = "SELECT 
        --Conmpte epargne  --
          ce.datedebut,
          ce.codeepargne,
          ce.typeClient,
          -- Produit epargne --
          pe.nomproduit,
        --   -- Solde  --
          SUM(tr.Montant) solde,

        --   -- individuel client --
          i.nom_client,
          i.prenom_client,
        --   -----------------------

        --   ----Groupe ----
          g.nomGroupe,
          g.email
         FROM App\Entity\CompteEpargne ce

         LEFT JOIN App\Entity\Individuelclient i
         with ce.codeep = i.codeclient

         LEFT JOIN App\Entity\Groupe g
         with ce.codeep = g.codegroupe

         INNER JOIN App\Entity\ProduitEpargne pe
         with pe.id = ce.produit

         LEFT JOIN App\Entity\Transaction tr
         with ce.codeepargne = tr.codeepargneclient 
         GROUP BY ce.codeepargne
         ";
 
         $statement = $this->getEntityManager()->createQuery($query)->execute();        
         return $statement;
    }
}
