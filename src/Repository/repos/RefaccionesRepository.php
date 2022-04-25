<?php

namespace App\Repository;

use App\Entity\Refacciones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Refacciones|null find($id, $lockMode = null, $lockVersion = null)
 * @method Refacciones|null findOneBy(array $criteria, array $orderBy = null)
 * @method Refacciones[]    findAll()
 * @method Refacciones[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RefaccionesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Refacciones::class);
    }

    // /**
    //  * @return Refacciones[] Returns an array of Refacciones objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Refacciones
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
