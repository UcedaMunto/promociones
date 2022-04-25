<?php

namespace App\Repository;

use App\Entity\PromoContactoSucursal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PromoContactoSucursal|null find($id, $lockMode = null, $lockVersion = null)
 * @method PromoContactoSucursal|null findOneBy(array $criteria, array $orderBy = null)
 * @method PromoContactoSucursal[]    findAll()
 * @method PromoContactoSucursal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromoContactoSucursalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PromoContactoSucursal::class);
    }

    // /**
    //  * @return PromoContactoSucursal[] Returns an array of PromoContactoSucursal objects
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
    public function findOneBySomeField($value): ?PromoContactoSucursal
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
