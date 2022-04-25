<?php

namespace App\Repository;

use App\Entity\EstadoActivo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EstadoActivo|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoActivo|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoActivo[]    findAll()
 * @method EstadoActivo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoActivoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadoActivo::class);
    }

    public function findAllArray(): ?Array 
    {
        return $this->createQueryBuilder('c')
        ->select(array('c.id', 'c.nombre'))
        ->getQuery()
        ->getArrayResult();    
    }

    // /**
    //  * @return EstadoActivo[] Returns an array of EstadoActivo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EstadoActivo
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
