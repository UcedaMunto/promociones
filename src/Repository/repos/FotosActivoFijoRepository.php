<?php

namespace App\Repository;

use App\Entity\FotosActivoFijo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FotosActivoFijo|null find($id, $lockMode = null, $lockVersion = null)
 * @method FotosActivoFijo|null findOneBy(array $criteria, array $orderBy = null)
 * @method FotosActivoFijo[]    findAll()
 * @method FotosActivoFijo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FotosActivoFijoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FotosActivoFijo::class);
    }

    // /**
    //  * @return FotosActivoFijo[] Returns an array of FotosActivoFijo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FotosActivoFijo
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
