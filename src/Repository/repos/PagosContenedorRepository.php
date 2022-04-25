<?php

namespace App\Repository;

use App\Entity\PagosContenedor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PagosContenedor|null find($id, $lockMode = null, $lockVersion = null)
 * @method PagosContenedor|null findOneBy(array $criteria, array $orderBy = null)
 * @method PagosContenedor[]    findAll()
 * @method PagosContenedor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PagosContenedorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PagosContenedor::class);
    }

    // /**
    //  * @return PagosContenedor[] Returns an array of PagosContenedor objects
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
    public function findOneBySomeField($value): ?PagosContenedor
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
