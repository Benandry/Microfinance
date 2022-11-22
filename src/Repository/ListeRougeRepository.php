<?php

namespace App\Repository;

use App\Entity\ListeRouge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ListeRouge>
 *
 * @method ListeRouge|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListeRouge|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListeRouge[]    findAll()
 * @method ListeRouge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListeRougeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListeRouge::class);
    }

    public function add(ListeRouge $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ListeRouge $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   public function ListeRouge()
   {
        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'SELECT
                -- liste rouge
                lr.dateliste,
                lr.raison,
                --  individuel
                (i.id) AS code,
                (i.nom_client) AS nom,
                (i.prenom_client) AS prenom
             FROM 
                App\Entity\ListeRouge lr,
                App\Entity\Individuelclient i WHERE  lr.codeclient = i.id GROUP BY lr.id'
        );

        return $query->getResult();
   }

   public function ListeRougeGroupe()
   {
        $entityManager=$this->getEntityManager();
        $query=$entityManager->createQuery(
            'SELECT
                -- liste rouge
                lr.dateliste,
                lr.raison,
                --  groupe
                g.id AS codegroupe,
                g.nomGroupe AS nomgroupe 
             FROM 
                App\Entity\ListeRouge lr,
                App\Entity\Groupe g WHERE  lr.codegroupe = g.id GROUP BY lr.id'
        );

        return $query->getResult();
   }
// Cette fonction permet de filtre entre deux date les listes rouge client individuel
public function ListeRougeIndividuel($Du,$Au)
{
       return $this->createQueryBuilder('l')
           ->innerJoin('l.codeclient','i')
           ->where('l.codeclient = i.id')
           ->andWhere('l.dateliste BETWEEN :Du AND :Au')
           ->andWhere('l.TypeClient = \'INDIVIDUEL\' ')
           ->setParameter(':Du', $Du)
           ->setParameter(':Au', $Au)
           ->getQuery()
           ->getResult()
           ;
    }
    
    // Cette fonction permet de filtre entre deux date les listes rouge client Groupe

    public function ListeRougeClientGroupe($Du,$Au)
    {
       return $this->createQueryBuilder('l')
           ->innerJoin('l.codegroupe','g')
           ->where('l.codegroupe = g.id')
           ->andWhere('l.dateliste BETWEEN :Du AND :Au')
           ->andWhere('l.TypeClient = \'GROUPE\' ')
           ->setParameter('Du', $Du)
           ->setParameter('Au', $Au)
           ->getQuery()
           ->getResult()
       ;
    }
}
