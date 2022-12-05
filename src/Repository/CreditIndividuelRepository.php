<?php

namespace App\Repository;

use App\Entity\CreditIndividuel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CreditIndividuel>
 *
 * @method CreditIndividuel|null find($id, $lockMode = null, $lockVersion = null)
 * @method CreditIndividuel|null findOneBy(array $criteria, array $orderBy = null)
 * @method CreditIndividuel[]    findAll()
 * @method CreditIndividuel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreditIndividuelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CreditIndividuel::class);
    }

    public function add(CreditIndividuel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CreditIndividuel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // Cette fonction permet de recuperer les informations sur les configuration credit
    public function api_configuration($produit){

        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT 
            -- credit individuel
            creditindividuel.TauxInteretAnnuel,
            creditindividuel.DifferementPayement,
            creditindividuel.Tranche,
            creditindividuel.TypeTranche,
            creditindividuel.CalculInteret,
            creditindividuel.MontantMaximumCredit,
            creditindividuel.MontantMinimumCredit,
            creditindividuel.DelaisDeGraceMaxi,
            creditindividuel.PaiementPrealableInteret,
            creditindividuel.CalculIntertPourDiffere,
            creditindividuel.IntaretDifferePaiementCapitalise,
            creditindividuel.InteretPayerDiffere,
            creditindividuel.TrancheDistinctInteret,
            creditindividuel.InteretDeductDecaissement,
            creditindividuel.CalculInteretJours,
            creditindividuel.ForfaitPaiementPrealableInteret,
            creditindividuel.PeriodeMinimumCredit,
            creditindividuel.PeriodeMaximumCredit,
            -- configuration general
            configeneralcredit.ProduitLieEpargne,
            configeneralcredit.NombreJourInteretAnnee,
            configeneralcredit.NombreSemaineAnnee,
            configeneralcredit.ProduitLieEpargne,
            configeneralcredit.NombreJourInteretAnnee,
            configeneralcredit.NombreSemaineAnnee,
            configeneralcredit.RecalculDateEcheanceDecaissement,
            configeneralcredit.TauxInteretVariableSoldeDegressif,
            configeneralcredit.RecalculInteretRemboursementAmortissementDegressif,
            configeneralcredit.MethodeSoldeDegressifComposeCalculInteret,
            configeneralcredit.ExclurePrdtLimttionDmdeEtDecaissDeuxiemeCrdt,
            configeneralcredit.AutorisationDecaissementPartiellement,
            -- configuration frais
            frais.TypeClient,
            frais.Papeterie,
            frais.Commission,
            frais.FraisDeDeveloppement,
            frais.FraisDeRefinancement,
            frais.CommissionCreditChaqueTrancheInd,
            frais.DroitTimbreSurCapital,
            frais.SurInteretCours
            -- produit credit
            -- produitcredit.NomProduitCredit,
            -- compte epargne
            compteepargne
            FROM
            App\Entity\CreditIndividuel creditindividuel  
              INNER JOIN
            App\Entity\ConfigurationGeneralCredit configeneralcredit
              INNER JOIN
            App\Entity\ProduitCredit produitcredit
                INNER JOIN
            App\Entity\FraisConfigCredit frais
               WITH
            produitcredit.id = configeneralcredit.ProduitCredit
               AND
            produitcredit.id = creditindividuel.ProduitCredit
                AND
            produitcredit.id = frais.ProduitCredit
                WHERE
             creditindividuel.ProduitCredit= :produit
            '
        )
        ->setParameter(':produit',$produit);

        return $query->execute();
    }

    // API pour les clients
    public function api_client_individuel($codeclient){
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
        'SELECT 
            individuel.nom_client nom,
            individuel.codeclient codeindividuel,
            compteepargne.codeepargne codeepargne
         FROM
         App\Entity\IndividuelClient individuel
         LEFT JOIN
         App\Entity\CompteEpargne compteepargne
            WITH
            compteepargne.codeep = individuel.codeclient
         WHERE individuel.codeclient =:codeclient')
         ->setParameter(':codeclient',$codeclient);

        return $query->getResult();
    }

//    /**
//     * @return CreditIndividuel[] Returns an array of CreditIndividuel objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CreditIndividuel
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
