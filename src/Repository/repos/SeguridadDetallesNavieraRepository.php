<?php

namespace App\Repository;

use App\Entity\SeguridadDetallesNaviera;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SeguridadDetallesNaviera|null find($id, $lockMode = null, $lockVersion = null)
 * @method SeguridadDetallesNaviera|null findOneBy(array $criteria, array $orderBy = null)
 * @method SeguridadDetallesNaviera[]    findAll()
 * @method SeguridadDetallesNaviera[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeguridadDetallesNavieraRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SeguridadDetallesNaviera::class);
    }

    // /**
    //  * @return SeguridadDetallesNaviera[] Returns an array of SeguridadDetallesNaviera objects
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
    public function findOneBySomeField($value): ?SeguridadDetallesNaviera
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
