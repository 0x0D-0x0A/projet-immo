<?php

namespace App\Repository;

use App\Entity\Annonce;
use App\Entity\Search;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Annonce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annonce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annonce[]    findAll()
 * @method Annonce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnonceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annonce::class);
    }
    ///////////////////////// recherche ////////////////////////
    
    /**
     * @return Query
     */
     public function findPaginateArticle(Search $search) 
    {
       $query = $this->createQueryBuilder('a')
                    ->orderBy('a.CreatedAt', 'DESC');

        if ($search->getSearchTitre()){
            $query = $query->andWhere('a.Titre LIKE :searchannoncetitre')
                            ->setParameter('searchannoncetitre', '%'.addcslashes($search->getSearchTitre(), '%_').'%');
        }

        if ($search->getSearchPrix()){
            $query = $query->andWhere('a.Prix LIKE :searchannonceprix')
                            ->setParameter('searchannonceprix', '%'.addcslashes($search->getSearchPrix(), '%_').'%');
        }

        if ($search->getSearchCategorie()){
            $query = $query->andWhere('a.Titre LIKE :searchannoncecategorie')
                            ->setParameter('searchannoncecategorie', '%'.addcslashes($search->getSearchCategorie(), '%_').'%');
        }

        if ($search->getSearchType()){
            $query = $query->andWhere('a.Titre LIKE :searchannoncetype')
                            ->setParameter('searchannoncetype', '%'.addcslashes($search->getSearchType(), '%_').'%');
        }

        return $query->getQuery();
    }
    /////////////////////////////////////////////////////////////

    ////////////////  Test requête pour récupérer les annonces créées par le user ///////////////

    /**
     * @return Query
     */
    public function findUserAnnonce(String $string)
    {
        $query = $this->createQueryBuilder('a')
                    ->orderBy('a.CreatedAt', 'DESC');

        if ($search->getSearchTitle()) {
            $query = $query->andWhere('a.Title LIKE :searcharticletitle')
                            ->setParameter('searcharticletitle', '%'.addcslashes($search->getSearchTitle(), '%_').'%');
        }

        return $query->getQuery();
    }

    /////////////////////////////////////////////////////////////////////////////////////////////



    // /**
    //  * @return Annonce[] Returns an array of Annonce objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Annonce
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

   
}
