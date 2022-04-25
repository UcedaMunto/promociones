<?php

namespace App\Repository;

use App\Entity\Puertos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Puertos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Puertos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Puertos[]    findAll()
 * @method Puertos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PuertosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Puertos::class);
    }

    // /**
    //  * @return Puertos[] Returns an array of Puertos objects
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
    public function findOneBySomeField($value): ?Puertos
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
