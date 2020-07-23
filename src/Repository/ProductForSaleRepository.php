<?php

namespace App\Repository;

use App\Entity\ProductForSale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductForSale|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductForSale|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductForSale[]    findAll()
 * @method ProductForSale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductForSaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductForSale::class);
    }

    public function prixMaxMiniPourEtatSuperieur($productId, $stateRank){

        $qb = $this->createQueryBuilder("pfs")
            ->select("MIN(pfs.prixMax)")
            ->join("pfs.state", "s")
            ->where("pfs.product=:ARTICLE_ID")
            ->setParameter("ARTICLE_ID", $productId)
            ->andWhere("s.rank>:STATE_RANK")
            ->setParameter("STATE_RANK", $stateRank);
        $res = $qb->getQuery()->getSingleScalarResult();

        dump($res);

        return $res;

    }

    public function prixMaxMiniPourEtatEgal($productId, $stateId){

        $qb = $this->createQueryBuilder("pfs")
            ->select("MIN(pfs.prixMax)")
            ->where("pfs.product=:ARTICLE_ID")
            ->setParameter("ARTICLE_ID", $productId)
            ->andWhere("pfs.state=:STATE_ID")
            ->setParameter("STATE_ID", $stateId);
        $res = $qb->getQuery()->getSingleScalarResult();

        dump($res);

        return $res;

    }

    // /**
    //  * @return ProductForSale[] Returns an array of ProductForSale objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProductForSale
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
