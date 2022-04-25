<?php

namespace App\Repository;

use App\Entity\EstadoMovimiento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EstadoMovimiento|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoMovimiento|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoMovimiento[]    findAll()
 * @method EstadoMovimiento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoMovimientoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadoMovimiento::class);
    }

    // /**
    //  * @return EstadoMovimiento[] Returns an array of EstadoMovimiento objects
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
    public function findOneBySomeField($value): ?EstadoMovimiento
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
