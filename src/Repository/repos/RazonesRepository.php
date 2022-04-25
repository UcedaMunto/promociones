<?php

namespace App\Repository;

use App\Entity\Razones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Razones|null find($id, $lockMode = null, $lockVersion = null)
 * @method Razones|null findOneBy(array $criteria, array $orderBy = null)
 * @method Razones[]    findAll()
 * @method Razones[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RazonesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Razones::class);
    }

    // /**
    //  * @return Razones[] Returns an array of Razones objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Razones
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
