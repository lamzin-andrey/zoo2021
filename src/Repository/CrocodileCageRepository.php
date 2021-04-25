<?php

namespace App\Repository;

use App\Entity\CrocodileCage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CrocodileCage|null find($id, $lockMode = null, $lockVersion = null)
 * @method CrocodileCage|null findOneBy(array $criteria, array $orderBy = null)
 * @method CrocodileCage[]    findAll()
 * @method CrocodileCage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CrocodileCageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CrocodileCage::class);
    }

    // /**
    //  * @return CrocodileCage[] Returns an array of CrocodileCage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CrocodileCage
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
