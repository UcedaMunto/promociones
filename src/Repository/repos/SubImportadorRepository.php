<?php

namespace App\Repository;

use App\Entity\SubImportador;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SubImportador|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubImportador|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubImportador[]    findAll()
 * @method SubImportador[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubImportadorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubImportador::class);
    }

    // /**
    //  * @return SubImportador[] Returns an array of SubImportador objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SubImportador
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
