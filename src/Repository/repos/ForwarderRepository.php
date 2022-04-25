<?php

namespace App\Repository;

use App\Entity\Forwarder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Forwarder|null find($id, $lockMode = null, $lockVersion = null)
 * @method Forwarder|null findOneBy(array $criteria, array $orderBy = null)
 * @method Forwarder[]    findAll()
 * @method Forwarder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForwarderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Forwarder::class);
    }

    // /**
    //  * @return Forwarder[] Returns an array of Forwarder objects
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
    public function findOneBySomeField($value): ?Forwarder
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
