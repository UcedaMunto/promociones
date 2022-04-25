<?php

namespace App\Repository;

use App\Entity\Pier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pier[]    findAll()
 * @method Pier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pier::class);
    }

    // /**
    //  * @return Pier[] Returns an array of Pier objects
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
    public function findOneBySomeField($value): ?Pier
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
