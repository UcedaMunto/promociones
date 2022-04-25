<?php

namespace App\Repository;

use App\Entity\EstadoYardas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EstadoYardas|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoYardas|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoYardas[]    findAll()
 * @method EstadoYardas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoYardasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadoYardas::class);
    }

    // /**
    //  * @return EstadoYardas[] Returns an array of EstadoYardas objects
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
    public function findOneBySomeField($value): ?EstadoYardas
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
