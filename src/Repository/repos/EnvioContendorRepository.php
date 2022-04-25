<?php

namespace App\Repository;

use App\Entity\EnvioContendor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EnvioContendor|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnvioContendor|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnvioContendor[]    findAll()
 * @method EnvioContendor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnvioContendorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnvioContendor::class);
    }

    // /**
    //  * @return EnvioContendor[] Returns an array of EnvioContendor objects
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
    public function findOneBySomeField($value): ?EnvioContendor
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
