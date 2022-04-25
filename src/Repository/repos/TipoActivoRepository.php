<?php

namespace App\Repository;

use App\Entity\TipoActivo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoActivo|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoActivo|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoActivo[]    findAll()
 * @method TipoActivo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoActivoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoActivo::class);
    }

    public function findAllArray( ): ?Array
    {
        return $this->createQueryBuilder('c')
                ->select(array('c.id','c.nombre'))
            ->getQuery()
            ->getArrayResult()
        ;
    }

    // /**
    //  * @return TipoActivo[] Returns an array of TipoActivo objects
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
    public function findOneBySomeField($value): ?TipoActivo
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
