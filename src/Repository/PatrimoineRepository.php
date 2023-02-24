<?php

namespace App\Repository;

use App\Entity\Patrimoine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Patrimoine>
 *
 * @method Patrimoine|null find($id, $lockMode = null, $lockVersion = null)
 * @method Patrimoine|null findOneBy(array $criteria, array $orderBy = null)
 * @method Patrimoine[]    findAll()
 * @method Patrimoine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatrimoineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Patrimoine::class);
    }

    public function save(Patrimoine $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Patrimoine $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

            /**
     * Undocumented function
     *@method mixed Patrimoine():Methode permet de liste les individuels pour enregistrer sont patrimoine
     * @param integer $idclient
     * @return array
     */
    public function Patrimoine($idclient):array
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

<<<<<<< HEAD
    /**
     * Undocumented function
     *@method mixed ListePatrimoine():Permet de lister les patrimoines d'une personne
     * @param [type] $codeclient:Code client individuel
     * @return array
    */
    public function ListePatrimoine(){
        $entityManager=$this->getEntityManager();

        $query=$entityManager->createQuery(
            'SELECT
                i.nom_client,
                i.prenom_client,
                p.IdClient,
                p.Libelle1,
                p.Montant1,
                p.Libelle2,
                p.Montant2,
                p.Libelle3,
                p.Montant3,
                p.Libelle4,
                p.Montant4,
                p.dateenregistrement,
                p.TotalPatrimoine
            FROM
                App\Entity\Individuelclient i
                INNER JOIN
                App\Entity\Patrimoine p
            WITH
                i.codeclient=p.IdClient
                '
        );


        return $query->getResult();
    }

=======


>>>>>>> 291b63e
//    /**
//     * @return Patrimoine[] Returns an array of Patrimoine objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Patrimoine
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
