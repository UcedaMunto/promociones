<?php

namespace App\Repository;

use App\Entity\BitacoraSistema;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BitacoraSistema|null find($id, $lockMode = null, $lockVersion = null)
 * @method BitacoraSistema|null findOneBy(array $criteria, array $orderBy = null)
 * @method BitacoraSistema[]    findAll()
 * @method BitacoraSistema[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BitacoraSistemaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BitacoraSistema::class);
    }
    /**
     * @return BitacoraSistema[] Returns an array of BitacoraSistema objects
     */
    public function finAllDesc()
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return BitacoraSistema[] Returns an array of BitacoraSistema objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BitacoraSistema
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
