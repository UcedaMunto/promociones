<?php

namespace App\Repository;

use App\Entity\TipoTitulo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoTitulo|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoTitulo|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoTitulo[]    findAll()
 * @method TipoTitulo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoTituloRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoTitulo::class);
    }

    // /**
    //  * @return TipoTitulo[] Returns an array of TipoTitulo objects
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
    public function findOneBySomeField($value): ?TipoTitulo
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
