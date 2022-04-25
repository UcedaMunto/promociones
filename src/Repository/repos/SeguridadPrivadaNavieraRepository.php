<?php

namespace App\Repository;

use App\Entity\SeguridadPrivadaNaviera;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SeguridadPrivadaNaviera|null find($id, $lockMode = null, $lockVersion = null)
 * @method SeguridadPrivadaNaviera|null findOneBy(array $criteria, array $orderBy = null)
 * @method SeguridadPrivadaNaviera[]    findAll()
 * @method SeguridadPrivadaNaviera[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeguridadPrivadaNavieraRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SeguridadPrivadaNaviera::class);
    }

    // /**
    //  * @return SeguridadPrivadaNaviera[] Returns an array of SeguridadPrivadaNaviera objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SeguridadPrivadaNaviera
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
