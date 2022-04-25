<?php

namespace App\Repository;

use App\Entity\PromoPromociones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PromoPromociones|null find($id, $lockMode = null, $lockVersion = null)
 * @method PromoPromociones|null findOneBy(array $criteria, array $orderBy = null)
 * @method PromoPromociones[]    findAll()
 * @method PromoPromociones[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromoPromocionesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PromoPromociones::class);
    }

    // /**
    //  * @return PromoPromociones[] Returns an array of PromoPromociones objects
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
    public function findOneBySomeField($value): ?PromoPromociones
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
