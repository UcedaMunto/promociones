<?php

namespace App\Repository;

use App\Entity\Yardas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Yardas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Yardas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Yardas[]    findAll()
 * @method Yardas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class YardasRepository extends ServiceEntityRepository
{
        
    public function yardasActivas()
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.estado = 1')
            ->orderBy('y.id', 'ASC')
        ;
    }

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Yardas::class);
    }

    // /**
    //  * @return Yardas[] Returns an array of Yardas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('y.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Yardas
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
