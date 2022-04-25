<?php

namespace App\Repository;

use App\Entity\TipoFlete;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoFlete|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoFlete|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoFlete[]    findAll()
 * @method TipoFlete[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoFleteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoFlete::class);
    }

    // /**
    //  * @return TipoFlete[] Returns an array of TipoFlete objects
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
    public function findOneBySomeField($value): ?TipoFlete
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
