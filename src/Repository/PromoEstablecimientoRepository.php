<?php

namespace App\Repository;

use App\Entity\PromoEstablecimiento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PromoEstablecimiento|null find($id, $lockMode = null, $lockVersion = null)
 * @method PromoEstablecimiento|null findOneBy(array $criteria, array $orderBy = null)
 * @method PromoEstablecimiento[]    findAll()
 * @method PromoEstablecimiento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromoEstablecimientoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PromoEstablecimiento::class);
    }

    public function findOne( ): ?PromoEstablecimiento
    {
        $rresultado= $this->createQueryBuilder('e')
            ->Where('e.id > 0')
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
        return $rresultado[0];
    }

    // /**
    //  * @return PromoEstablecimiento[] Returns an array of PromoEstablecimiento objects
    //  */
    /*
    public function findByExampleField($value)
    {

        $rresultado= $this->createQueryBuilder('e')
            ->leftJoin('e.detalleCompra', 'dc')
            ->Where('dc.lote = :lote')
            ->setParameter('lote', $lote )
            ->getQuery()
            ->getOneOrNullResult()
            ;


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
    public function findOneBySomeField($value): ?Contacto
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
