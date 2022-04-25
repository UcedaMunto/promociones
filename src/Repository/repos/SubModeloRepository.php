<?php

namespace App\Repository;

use App\Entity\SubModelo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SubModelo|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubModelo|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubModelo[]    findAll()
 * @method SubModelo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubModeloRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubModelo::class);
    }

    // /**
    //  * @return SubModelo[] Returns an array of SubModelo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SubModelo
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
