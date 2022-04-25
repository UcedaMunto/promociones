<?php

namespace App\Repository;

use App\Entity\WorkOrderTipoCarga;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WorkOrderTipoCarga|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkOrderTipoCarga|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkOrderTipoCarga[]    findAll()
 * @method WorkOrderTipoCarga[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkOrderTipoCargaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkOrderTipoCarga::class);
    }

    // /**
    //  * @return WorkOrderTipoCarga[] Returns an array of WorkOrderTipoCarga objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WorkOrderTipoCarga
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
