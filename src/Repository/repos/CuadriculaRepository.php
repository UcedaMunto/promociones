<?php

namespace App\Repository;

use App\Entity\Cuadricula;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cuadricula|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cuadricula|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cuadricula[]    findAll()
 * @method Cuadricula[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CuadriculaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cuadricula::class);
    }

    // /**
    //  * @return Cuadricula[] Returns an array of Cuadricula objects
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
    public function findOneBySomeField($value): ?Cuadricula
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
