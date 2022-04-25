<?php

namespace App\Repository;

use App\Entity\EstadoDockReceipt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EstadoDockReceipt|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoDockReceipt|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoDockReceipt[]    findAll()
 * @method EstadoDockReceipt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoDockReceiptRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadoDockReceipt::class);
    }

    // /**
    //  * @return EstadoDockReceipt[] Returns an array of EstadoDockReceipt objects
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
    public function findOneBySomeField($value): ?EstadoDockReceipt
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
