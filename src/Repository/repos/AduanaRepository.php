<?php

namespace App\Repository;

use App\Entity\Aduana;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Aduana|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aduana|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aduana[]    findAll()
 * @method Aduana[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AduanaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aduana::class);
    }

    // /**
    //  * @return Aduana[] Returns an array of Aduana objects
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
    public function findOneBySomeField($value): ?Aduana
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
