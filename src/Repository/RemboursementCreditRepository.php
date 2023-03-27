<?php

namespace App\Repository;

use App\Entity\RemboursementCredit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Config\Framework\HttpClient\DefaultOptions\RetryFailedConfig;

/**
 * @extends ServiceEntityRepository<RemboursementCredit>
 *
 * @method RemboursementCredit|null find($id, $lockMode = null, $lockVersion = null)
 * @method RemboursementCredit|null findOneBy(array $criteria, array $orderBy = null)
 * @method RemboursementCredit[]    findAll()
 * @method RemboursementCredit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RemboursementCreditRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RemboursementCredit::class);
    }

    public function save(RemboursementCredit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RemboursementCredit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Methode utilise sur le modal passée en perte
     *
     * @method mixed PerteDonnees()
     * @param [type] $idcredit
     * @return void
     */
    public function PerteDonnees($idcredit)
    {
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT
                demande.NumeroCredit,
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
                demande.id=:idcredit
            '
        )
        ->setParameter('idcredit',$idcredit);

        return $query->getResult();
    }

    /**
     * @method mixed Remboursement()
     * @return array
     */

    public function Remboursement(){
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT DISTINCT
                remboursement.NumeroCredit
                -- decaissement
            FROM
                -- App\Entity\DemandeCredit demande                
                -- INNER JOIN
                -- App\Entity\Decaissement decaissement
                -- WITH
                -- demande.NumeroCredit=decaissement.numeroCredit

                -- INNER JOIN
                App\Entity\RemboursementCredit remboursement
                -- WITH
                -- remboursement.NumeroCredit=decaissement.numeroCredit

                -- INNER JOIN
                -- App\Entity\IndividuelClient individuel
                -- WITH
                -- individuel.codeclient=demande.codeclient
                '
        ) ;
        
        return $query->getResult();

    }

    /**
     * Api remboursement 
     *
     * @return $query
     */
    
    public function ApiRemboursement($numerocredit,$periode)
    {
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT DISTINCT
            -- amortissement
                amortissement.periode,
                amortissement.dateRemborsement,
                amortissement.principale,
                amortissement.interet,
                amortissement.montanttTotal,
                amortissement.codeclient,
                amortissement.annuite,
                amortissement.penalite,
                amortissement.commission,
                amortissement.codecredit,
                amortissement.typeamortissement,
            -- remboursement
                remboursement.periode perioderemboursement,
                remboursement.MontantTotalPaye montantrembourse,
                remboursement.penalite penaliteremboursement,
                remboursement.NumeroCredit,
                -- Configuration
                configurationc.RetardPourcentage,
                configurationc.RetardForfaitaire,
                configurationc.PenalitePayementAntcp,
                configurationc.PenaliteAnticipe,
                configurationc.PenalitePourcentage
            FROM

                App\Entity\AmortissementFixe amortissement
                LEFT JOIN
                App\Entity\RemboursementCredit remboursement
            WITH
                amortissement.codecredit = remboursement.NumeroCredit
                AND
                 amortissement.periode = remboursement.periode

            INNER JOIN
                App\Entity\DemandeCredit demande
            WITH
                amortissement.codecredit = demande.NumeroCredit

                INNER JOIN
                App\Entity\ProduitCredit produitc
                WITH
                produitc.id=demande.ProduitCredit

                INNER JOIN
                App\Entity\ConfigurationCredit configurationc
                WITH
                produitc.id=configurationc.idProduit

            WHERE
                amortissement.codecredit = :numerocredit
                AND
                amortissement.periode = :periode
                '
        )
        ->setParameter(':numerocredit',$numerocredit)
        ->setParameter(':periode',$periode)
        ;
        
        return $query->getResult();
    }


    /**
     * Undocumented function
     *@method mixed ComparaisonRemboursement() : Methode permet de comparer le montant rembourser et l'echeance
     * @return void
     */
    public function ComparaisonRemboursement($numerocredit,$periode){
        
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT 
            -- Ammortissemnt fixe
                amortissement.periode periodeammort,
                amortissement.dateRemborsement dateammort,
                amortissement.principale principaleammort,
                amortissement.interet interetammort,
                amortissement.montanttTotal montanttotalammort,
                amortissement.codeclient codeclientammort,
                amortissement.annuite annuiteammort,
                amortissement.penalite penaliteammort,
                amortissement.commission commissionammort,
                amortissement.codecredit codecreditammort,
                amortissement.typeamortissement typeammortissementammort,
            -- Remboursement
                remboursement.NumeroCredit,
                remboursement.DateRemboursement,
                remboursement.PieceCompteble,
                remboursement.MontantTotalPaye,
                remboursement.Papeterie,
                remboursement.TransactionEnLiquide,
                remboursement.TransfertEpargne,
                remboursement.periode,
                remboursement.penalite,
                remboursement.Commentaire,
                remboursement.Anticipe
            FROM
                App\Entity\AmortissementFixe amortissement
                    LEFT JOIN
                App\Entity\RemboursementCredit remboursement
                WITH
                amortissement.codecredit = remboursement.NumeroCredit
            WHERE
                amortissement.periode = :periode
                AND
                amortissement.codecredit = :numerocredit
                '
        )
        ->setParameter(':numerocredit',$numerocredit)
        ->setParameter(':periode',$periode)
        ;
        
        return $query->getResult();

    }


        /**
     * Api remboursement pour l'ammortissement
     *
     * @param integer $periode periode de remboursement credit
     * @return $query
     */
    public function ApiRemboursementAmmortissement($numerocredit,$periode)
    {
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT DISTINCT
            -- amortissement
                amortissement.periode,
                amortissement.dateRemborsement,
                amortissement.principale,
                amortissement.interet,
                amortissement.montanttTotal,
                amortissement.codeclient,
                amortissement.annuite,
                amortissement.penalite,
                amortissement.commission,
                amortissement.codecredit,
                amortissement.typeamortissement,
                -- Configuration
                configurationc.RetardPourcentage,
                configurationc.RetardForfaitaire,
                configurationc.PenalitePayementAntcp,
                configurationc.PenaliteAnticipe,
                configurationc.PenalitePourcentage

            FROM
                App\Entity\AmortissementFixe amortissement
                INNER JOIN
                App\Entity\DemandeCredit demande
                WITH
                demande.NumeroCredit=amortissement.codecredit

                INNER JOIN
                App\Entity\ProduitCredit produitc
                WITH
                produitc.id=demande.ProduitCredit

                INNER JOIN
                App\Entity\ConfigurationCredit configurationc
                WITH
                produitc.id=configurationc.idProduit

            WHERE
            amortissement.codecredit= :numerocredit
                AND
                amortissement.periode = :periode                
            ORDER BY amortissement.periode
                '
        )
        ->setParameter(':numerocredit',$numerocredit)
        ->setParameter(':periode',$periode)
        ->setMaxResults(1)
        ;
        
        return $query->getResult();
    }

    /**
     * Undocumented function
     *@method mixed DernierRemboursement()
     * @param [type] $numerocredit
     * @return string
     */
    public function RemboursementActuel($numerocredit,$periode)
    {
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT
            -- amortissement
                amortissement.periode,
                amortissement.dateRemborsement,
                amortissement.principale,
                amortissement.interet,
                amortissement.montanttTotal,
                amortissement.codeclient,
                amortissement.annuite,
                amortissement.penalite,
                amortissement.commission,
                amortissement.codecredit,
                amortissement.typeamortissement
            -- remboursement
                -- remboursement.periode perioderemboursementModal,
                -- remboursement.MontantTotalPaye montantrembourseModal,
                -- remboursement.penalite penaliteremboursementModal,
                -- remboursement.NumeroCredit,
                -- remboursement.DateRemboursement,
                -- remboursement.PieceCompteble,
                -- remboursement.Papeterie,
                -- remboursement.TransactionEnLiquide,
                -- remboursement.TransfertEpargne,
                -- remboursement.Commentaire

            FROM
                App\Entity\AmortissementFixe amortissement
            -- LEFT JOIN
            --     App\Entity\RemboursementCredit remboursement
            -- WITH
            --     amortissement.periode = remboursement.periode
            --     AND 
            --     amortissement.codecredit = remboursement.NumeroCredit
            WHERE
                amortissement.codecredit = :numerocredit    
                AND
                amortissement.periode = :periode
                '
        )
        ->setParameter(':numerocredit',$numerocredit)
        ->setParameter(':periode',$periode)
        ;

        return $query->getResult();
    }

        /**
     * Api remboursement modal
     *
     * @param integer $periode periode de remboursement credit
     * @return $query
     */
    public function ApiRemboursementModal($numerocredit)
    {
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT
            -- demande credit
                demande.NombreTranche,
            -- amortissement
                amortissement.periode,
                amortissement.dateRemborsement,
                amortissement.principale,
                amortissement.interet,
                amortissement.montanttTotal,
                amortissement.codeclient,
                amortissement.annuite,
                amortissement.penalite,
                amortissement.commission,
                amortissement.codecredit,
                amortissement.typeamortissement,
            -- remboursement
                remboursement.id,
                remboursement.periode perioderemboursementModal,
                remboursement.MontantTotalPaye montantrembourseModal,
                remboursement.penalite penaliteremboursementModal,
                remboursement.NumeroCredit,
                remboursement.DateRemboursement,
                remboursement.PieceCompteble,
                remboursement.Papeterie,
                remboursement.TransactionEnLiquide,
                remboursement.TransfertEpargne,
                remboursement.Commentaire,
                remboursement.PieceCompteble
            FROM
                App\Entity\DemandeCredit demande
                INNER JOIN
                App\Entity\AmortissementFixe amortissement
                WITH
                demande.NumeroCredit=amortissement.codecredit

                LEFT JOIN
                App\Entity\RemboursementCredit remboursement
                WITH
                amortissement.codecredit = remboursement.NumeroCredit

            WHERE
            demande.id = :numerocredit
            ORDER BY remboursement.periode DESC
            '
        )
        ->setParameter(':numerocredit',$numerocredit)
        ->setMaxResults(1)
        ;

        return $query->getResult();
    }


    /**
     * @method mixed CreditSomme():Permet de recuperer la somme des argents concernant le credit
     * @param mixed $numerocredit
     * @return mixed array()
    */

     public function CreditSomme($numerocredit){

        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'SELECT DISTINCT
            -- amortissement
                (demande.Montant+(demande.Montant*demande.TauxInteretAnnuel/100)) crd,
            -- credit deja rembourser
                SUM(remboursement.MontantTotalPaye) TotalRembourser,
            -- credit pas encore rembourser
            (demande.Montant+(demande.Montant*demande.TauxInteretAnnuel/100))-SUM(remboursement.MontantTotalPaye) TotalARembourser

             FROM
                App\Entity\DemandeCredit demande
                INNER JOIN
                App\Entity\AmortissementFixe ammortissement
                WITH
                demande.NumeroCredit=ammortissement.codecredit
             
             LEFT JOIN
                App\Entity\RemboursementCredit remboursement
             WITH
                ammortissement.periode = remboursement.periode
                AND
                ammortissement.codecredit=remboursement.NumeroCredit
             WHERE
             demande.id =  :numerocredit
            '
            )
            ->setParameter(':numerocredit',$numerocredit);

        return  $query->getResult();


    }


    /**
     * @method   HistoriqueRemboursement() : Methode permet de suivre
     * l'historique du remboursement
     *
     * @return void
     */
    public function HistoriqueRemboursement($codecredit)
    {
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT DISTINCT
            -- amortissement
                (amortissement.periode) periode,
                amortissement.dateRemborsement,
                amortissement.principale,
                amortissement.interet,
                amortissement.montanttTotal,
                amortissement.codeclient,
                amortissement.annuite,
                amortissement.penalite,
                amortissement.commission,
                amortissement.codecredit,
                amortissement.typeamortissement,
            -- remboursement
                remboursement.periode perioderemboursement,
                (remboursement.MontantTotalPaye) montantrembourse,
                (remboursement.penalite) penaliteremboursement,
                remboursement.NumeroCredit,
                remboursement.DateRemboursement dateremb,
                remboursement.Capital,
                remboursement.Interet
            FROM
                App\Entity\AmortissementFixe amortissement
                INNER JOIN
                App\Entity\RemboursementCredit remboursement
            WITH
                amortissement.codecredit = remboursement.NumeroCredit
                AND
                 amortissement.periode = remboursement.periode

                INNER JOIN
                App\Entity\DemandeCredit demande
                WITH
                demande.NumeroCredit=amortissement.codecredit

            WHERE
            amortissement.codecredit= :codecredit          
            '
        )
        ->setParameter(':codecredit',$codecredit);

        return $query->getResult();
    }

    /**
     * @method mixed TableauAmmortissement() : methode permet de retourner 
     * la table d'ammortissement
     *
     * @return void
     * 
     */
    public function TableauAmmortissement($codecredit)
    {
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT DISTINCT
            -- amortissement
                amortissement.periode,
                amortissement.dateRemborsement,
                amortissement.principale,
                amortissement.interet,
                amortissement.montanttTotal,
                amortissement.codeclient,
                amortissement.annuite,
                amortissement.penalite,
                amortissement.commission,
                amortissement.codecredit,
                amortissement.typeamortissement,
                amortissement.soldedu,
                amortissement.MontantRestantDu,
                amortissement.InteretDu
            FROM
                App\Entity\AmortissementFixe amortissement
                INNER JOIN
                App\Entity\DemandeCredit demande
                WITH
                amortissement.codecredit=demande.NumeroCredit
            WHERE
            amortissement.codecredit = :codecredit
            ')
            ->setParameter(':codecredit',$codecredit);

            return $query->getResult();
    }


//    /**
//     * @return RemboursementCredit[] Returns an array of RemboursementCredit objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RemboursementCredit
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
