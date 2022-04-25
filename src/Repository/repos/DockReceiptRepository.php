<?php

namespace App\Repository;

use App\Entity\DockReceipt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DockReceipt|null find($id, $lockMode = null, $lockVersion = null)
 * @method DockReceipt|null findOneBy(array $criteria, array $orderBy = null)
 * @method DockReceipt[]    findAll()
 * @method DockReceipt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DockReceiptRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DockReceipt::class);
    }

    // /**
    //  * @return DockReceipt[] Returns an array of DockReceipt objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DockReceipt
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
