<?php

namespace App\Repository;

use App\Entity\TipoPuerto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoPuerto|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoPuerto|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoPuerto[]    findAll()
 * @method TipoPuerto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoPuertoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoPuerto::class);
    }

    // /**
    //  * @return TipoPuerto[] Returns an array of TipoPuerto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TipoPuerto
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
