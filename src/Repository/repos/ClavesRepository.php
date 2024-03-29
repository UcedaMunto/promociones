<?php

namespace App\Repository;

use App\Entity\Claves;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Claves|null find($id, $lockMode = null, $lockVersion = null)
 * @method Claves|null findOneBy(array $criteria, array $orderBy = null)
 * @method Claves[]    findAll()
 * @method Claves[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClavesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Claves::class);
    }

    // /**
    //  * @return Claves[] Returns an array of Claves objects
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
    public function findOneBySomeField($value): ?Claves
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
