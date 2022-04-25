<?php

namespace App\Repository;

use App\Entity\EstadoImportador;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EstadoImportador|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoImportador|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoImportador[]    findAll()
 * @method EstadoImportador[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoImportadorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadoImportador::class);
    }

    // /**
    //  * @return EstadoImportador[] Returns an array of EstadoImportador objects
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
    public function findOneBySomeField($value): ?EstadoImportador
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
