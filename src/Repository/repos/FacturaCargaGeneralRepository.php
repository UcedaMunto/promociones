<?php

namespace App\Repository;

use App\Entity\FacturaCargaGeneral;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FacturaCargaGeneral|null find($id, $lockMode = null, $lockVersion = null)
 * @method FacturaCargaGeneral|null findOneBy(array $criteria, array $orderBy = null)
 * @method FacturaCargaGeneral[]    findAll()
 * @method FacturaCargaGeneral[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FacturaCargaGeneralRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FacturaCargaGeneral::class);
    }

    // /**
    //  * @return FacturaCargaGeneral[] Returns an array of FacturaCargaGeneral objects
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
    public function findOneBySomeField($value): ?FacturaCargaGeneral
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
