<?php

namespace App\Repository;

use App\Entity\Naviera;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Naviera|null find($id, $lockMode = null, $lockVersion = null)
 * @method Naviera|null findOneBy(array $criteria, array $orderBy = null)
 * @method Naviera[]    findAll()
 * @method Naviera[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NavieraRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Naviera::class);
    }

    // /**
    //  * @return Naviera[] Returns an array of Naviera objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Naviera
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
