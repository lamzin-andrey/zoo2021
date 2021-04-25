<?php

namespace App\Repository;

use App\Entity\Crocodile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Crocodile|null find($id, $lockMode = null, $lockVersion = null)
 * @method Crocodile|null findOneBy(array $criteria, array $orderBy = null)
 * @method Crocodile[]    findAll()
 * @method Crocodile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CrocodileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Crocodile::class);
    }

    // /**
    //  * @return Crocodile[] Returns an array of Crocodile objects
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
    public function findOneBySomeField($value): ?Crocodile
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
