<?php

namespace App\Repository;

use App\Entity\Cilindrage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cilindrage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cilindrage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cilindrage[]    findAll()
 * @method Cilindrage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CilindrageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cilindrage::class);
    }

    // /**
    //  * @return Cilindrage[] Returns an array of Cilindrage objects
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
    public function findOneBySomeField($value): ?Cilindrage
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
