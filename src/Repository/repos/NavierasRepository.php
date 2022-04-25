<?php

namespace App\Repository;

use App\Entity\Navieras;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Navieras|null find($id, $lockMode = null, $lockVersion = null)
 * @method Navieras|null findOneBy(array $criteria, array $orderBy = null)
 * @method Navieras[]    findAll()
 * @method Navieras[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NavierasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Navieras::class);
    }

    // /**
    //  * @return Navieras[] Returns an array of Navieras objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Navieras
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
