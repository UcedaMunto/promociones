<?php

namespace App\Repository;

use App\Entity\CompaniasGrua;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompaniasGrua|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompaniasGrua|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompaniasGrua[]    findAll()
 * @method CompaniasGrua[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompaniasGruaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompaniasGrua::class);
    }

    // /**
    //  * @return CompaniasGrua[] Returns an array of CompaniasGrua objects
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
    public function findOneBySomeField($value): ?CompaniasGrua
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
