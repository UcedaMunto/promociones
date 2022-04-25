<?php

namespace App\Repository;

use App\Entity\TipoPagoContenedor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoPagoContenedor|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoPagoContenedor|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoPagoContenedor[]    findAll()
 * @method TipoPagoContenedor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoPagoContenedorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoPagoContenedor::class);
    }

    // /**
    //  * @return TipoPagoContenedor[] Returns an array of TipoPagoContenedor objects
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
    public function findOneBySomeField($value): ?TipoPagoContenedor
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
