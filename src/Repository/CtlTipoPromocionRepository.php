<?php

namespace App\Repository;

use App\Entity\CtlTipoPromocion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtlTipoPromocion|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtlTipoPromocion|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtlTipoPromocion[]    findAll()
 * @method CtlTipoPromocion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtlTipoPromocionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtlTipoPromocion::class);
    }

    // /**
    //  * @return CtlTipoPromocion[] Returns an array of CtlTipoPromocion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CtlTipoPromocion
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
