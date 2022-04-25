<?php

namespace App\Repository;

use App\Entity\EnvioContenedor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EnvioContenedor|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnvioContenedor|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnvioContenedor[]    findAll()
 * @method EnvioContenedor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnvioContenedorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnvioContenedor::class);
    }

    // /**
    //  * @return EnvioContenedor[] Returns an array of EnvioContenedor objects
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
    public function findOneBySomeField($value): ?EnvioContenedor
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
