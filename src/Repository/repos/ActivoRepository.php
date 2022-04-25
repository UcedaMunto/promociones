<?php

namespace App\Repository;

use App\Entity\Activo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Activo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activo[]    findAll()
 * @method Activo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activo::class);
    }

    public function getFotosActivos($activo): ?Array
    {
        return $this->createQueryBuilder('c')
            ->select(
                array('f.id', 'f.creacion', 'f.nombre') 
            )
            ->leftjoin('c.fotosActivo', 'f')
            ->Where('f.activo = :activo')
            ->setParameter('activo', $activo->getId() )
            ->getQuery()
            ->getArrayResult()
        ;
    }


    // /**
    //  * @return Activo[] Returns an array of Activo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Activo
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
