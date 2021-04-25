<?php

namespace App\Repository;

use App\Entity\ElephantCage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ElephantCage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ElephantCage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ElephantCage[]    findAll()
 * @method ElephantCage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElephantCageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ElephantCage::class);
    }

    // /**
    //  * @return ElephantCage[] Returns an array of ElephantCage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ElephantCage
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
