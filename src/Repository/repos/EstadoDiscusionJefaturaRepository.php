<?php

namespace App\Repository;

use App\Entity\EstadoDiscusionJefatura;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EstadoDiscusionJefatura|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoDiscusionJefatura|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoDiscusionJefatura[]    findAll()
 * @method EstadoDiscusionJefatura[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoDiscusionJefaturaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadoDiscusionJefatura::class);
    }

    // /**
    //  * @return EstadoDiscusionJefatura[] Returns an array of EstadoDiscusionJefatura objects
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
    public function findOneBySomeField($value): ?EstadoDiscusionJefatura
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
