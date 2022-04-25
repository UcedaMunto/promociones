<?php

namespace App\Repository;

use App\Entity\ImportadorCargaGeneral;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImportadorCargaGeneral|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImportadorCargaGeneral|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImportadorCargaGeneral[]    findAll()
 * @method ImportadorCargaGeneral[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImportadorCargaGeneralRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImportadorCargaGeneral::class);
    }

    // /**
    //  * @return ImportadorCargaGeneral[] Returns an array of ImportadorCargaGeneral objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImportadorCargaGeneral
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
