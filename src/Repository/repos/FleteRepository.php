<?php

namespace App\Repository;

use App\Entity\Flete;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Flete|null find($id, $lockMode = null, $lockVersion = null)
 * @method Flete|null findOneBy(array $criteria, array $orderBy = null)
 * @method Flete[]    findAll()
 * @method Flete[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FleteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flete::class);
    }

    public function fleteYardasActivas(){
        return $this->createQueryBuilder('a')
            ->leftJoin('a.yarda', 'yarda')
            ->andWhere('yarda.estado = 1 or yarda.id is null');
        ;
    }
    public function coleccionFletesActivos()
    {
        return $this->fleteYardasActivas()
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Flete[] Returns an array of Flete objects
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
    public function findOneBySomeField($value): ?Flete
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
