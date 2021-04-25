<?php

namespace App\Repository;

use App\Entity\Lion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lion[]    findAll()
 * @method Lion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lion::class);
    }

    // /**
    //  * @return Lion[] Returns an array of Lion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Lion
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
