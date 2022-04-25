<?php

namespace App\Repository;

use App\Entity\TipoEmbalage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoEmbalage|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoEmbalage|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoEmbalage[]    findAll()
 * @method TipoEmbalage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoEmbalageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoEmbalage::class);
    }

    // /**
    //  * @return TipoEmbalage[] Returns an array of TipoEmbalage objects
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
    public function findOneBySomeField($value): ?TipoEmbalage
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
