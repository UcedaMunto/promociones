<?php

namespace App\Repository;

use App\Entity\TipoCompra;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoCompra|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoCompra|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoCompra[]    findAll()
 * @method TipoCompra[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoCompraRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoCompra::class);
    }

    // /**
    //  * @return TipoCompra[] Returns an array of TipoCompra objects
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
    public function findOneBySomeField($value): ?TipoCompra
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
