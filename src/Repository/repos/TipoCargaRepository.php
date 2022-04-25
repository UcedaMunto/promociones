<?php

namespace App\Repository;

use App\Entity\TipoCarga;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoCarga|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoCarga|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoCarga[]    findAll()
 * @method TipoCarga[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoCargaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoCarga::class);
    }

    // /**
    //  * @return TipoCarga[] Returns an array of TipoCarga objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TipoCarga
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
