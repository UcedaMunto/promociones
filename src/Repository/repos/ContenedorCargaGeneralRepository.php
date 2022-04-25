<?php

namespace App\Repository;

use App\Entity\ContenedorCargaGeneral;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContenedorCargaGeneral|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContenedorCargaGeneral|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContenedorCargaGeneral[]    findAll()
 * @method ContenedorCargaGeneral[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContenedorCargaGeneralRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContenedorCargaGeneral::class);
    }

    // /**
    //  * @return ContenedorCargaGeneral[] Returns an array of ContenedorCargaGeneral objects
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
    public function findOneBySomeField($value): ?ContenedorCargaGeneral
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
