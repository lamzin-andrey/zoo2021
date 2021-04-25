<?php

namespace App\Repository;

use App\Entity\LionCage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LionCage|null find($id, $lockMode = null, $lockVersion = null)
 * @method LionCage|null findOneBy(array $criteria, array $orderBy = null)
 * @method LionCage[]    findAll()
 * @method LionCage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LionCageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LionCage::class);
    }

    // /**
    //  * @return LionCage[] Returns an array of LionCage objects
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
    public function findOneBySomeField($value): ?LionCage
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
