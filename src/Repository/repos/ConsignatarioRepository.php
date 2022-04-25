<?php

namespace App\Repository;

use App\Entity\Consignatario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Consignatario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Consignatario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Consignatario[]    findAll()
 * @method Consignatario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsignatarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Consignatario::class);
    }

    // /**
    //  * @return Consignatario[] Returns an array of Consignatario objects
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
    public function findOneBySomeField($value): ?Consignatario
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
