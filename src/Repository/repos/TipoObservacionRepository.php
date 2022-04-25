<?php

namespace App\Repository;

use App\Entity\TipoObservacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoObservacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoObservacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoObservacion[]    findAll()
 * @method TipoObservacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoObservacionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoObservacion::class);
    }

    // /**
    //  * @return TipoObservacion[] Returns an array of TipoObservacion objects
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
    public function findOneBySomeField($value): ?TipoObservacion
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
