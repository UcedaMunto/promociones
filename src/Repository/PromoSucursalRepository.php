<?php

namespace App\Repository;

use App\Entity\PromoSucursal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PromoSucursal|null find($id, $lockMode = null, $lockVersion = null)
 * @method PromoSucursal|null findOneBy(array $criteria, array $orderBy = null)
 * @method PromoSucursal[]    findAll()
 * @method PromoSucursal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromoSucursalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PromoSucursal::class);
    }

    // /**
    //  * @return PromoSucursal[] Returns an array of PromoSucursal objects
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
    public function findOneBySomeField($value): ?PromoSucursal
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
