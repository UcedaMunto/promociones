<?php

namespace App\Repository;

use App\Entity\PromoAviso;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PromoAviso|null find($id, $lockMode = null, $lockVersion = null)
 * @method PromoAviso|null findOneBy(array $criteria, array $orderBy = null)
 * @method PromoAviso[]    findAll()
 * @method PromoAviso[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromoAvisoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PromoAviso::class);
    }

    // /**
    //  * @return PromoAviso[] Returns an array of PromoAviso objects
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
    public function findOneBySomeField($value): ?PromoCategoria
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
