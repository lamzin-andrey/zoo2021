<?php

namespace App\Repository;

use App\Entity\EmptyCage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmptyCage|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmptyCage|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmptyCage[]    findAll()
 * @method EmptyCage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmptyCageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmptyCage::class);
    }

    // /**
    //  * @return EmptyCage[] Returns an array of EmptyCage objects
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
    public function findOneBySomeField($value): ?EmptyCage
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
