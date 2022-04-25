<?php

namespace App\Repository;

use App\Entity\TipoCliente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoCliente|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoCliente|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoCliente[]    findAll()
 * @method TipoCliente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoClienteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoCliente::class);
    }

    // /**
    //  * @return TipoCliente[] Returns an array of TipoCliente objects
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
    public function findOneBySomeField($value): ?TipoCliente
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
