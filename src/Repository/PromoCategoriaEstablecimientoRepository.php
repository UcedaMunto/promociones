<?php

namespace App\Repository;

use App\Entity\PromoCategoriaEstablecimiento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PromoCategoriaEstablecimiento|null find($id, $lockMode = null, $lockVersion = null)
 * @method PromoCategoriaEstablecimiento|null findOneBy(array $criteria, array $orderBy = null)
 * @method PromoCategoriaEstablecimiento[]    findAll()
 * @method PromoCategoriaEstablecimiento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromoCategoriaEstablecimientoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PromoCategoriaEstablecimiento::class);
    }

    // /**
    //  * @return PromoCategoriaEstablecimiento[] Returns an array of PromoCategoriaEstablecimiento objects
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
    public function findOneBySomeField($value): ?PromoCategoriaEstablecimiento
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
