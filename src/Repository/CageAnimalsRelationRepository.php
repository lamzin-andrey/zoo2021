<?php

namespace App\Repository;

use App\Entity\CageAnimalsRelation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CageAnimalsRelation|null find($id, $lockMode = null, $lockVersion = null)
 * @method CageAnimalsRelation|null findOneBy(array $criteria, array $orderBy = null)
 * @method CageAnimalsRelation[]    findAll()
 * @method CageAnimalsRelation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CageAnimalsRelationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CageAnimalsRelation::class);
    }

    /**
     *
     * @param $
     * @return
    */
    public function findCages() : array
    {
        // 'SELECT id FROM cage_animals_relation  GROUP BY cage_id'
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = $this->createQueryBuilder('t');
        // $e = $queryBuilder->expr();
        $queryBuilder->groupBy('t.cage_id');

        return $queryBuilder->getQuery()->execute();
    }

    // /**
    //  * @return CageAnimalsRelation[] Returns an array of CageAnimalsRelation objects
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
    public function findOneBySomeField($value): ?CageAnimalsRelation
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
