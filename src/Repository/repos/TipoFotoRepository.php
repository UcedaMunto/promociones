<?php

namespace App\Repository;

use App\Entity\TipoFoto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoFoto|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoFoto|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoFoto[]    findAll()
 * @method TipoFoto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoFotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoFoto::class);
    }

    // /**
    //  * @return TipoFoto[] Returns an array of TipoFoto objects
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
    public function findOneBySomeField($value): ?TipoFoto
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
