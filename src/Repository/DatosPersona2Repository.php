<?php

namespace App\Repository;

use App\Entity\DatosPersona2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DatosPersona2|null find($id, $lockMode = null, $lockVersion = null)
 * @method DatosPersona2|null findOneBy(array $criteria, array $orderBy = null)
 * @method DatosPersona2[]    findAll()
 * @method DatosPersona2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DatosPersona2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DatosPersona2::class);
    }

    // /**
    //  * @return DatosPersona2[] Returns an array of DatosPersona2 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DatosPersona2
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
