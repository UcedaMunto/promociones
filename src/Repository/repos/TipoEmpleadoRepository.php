<?php

namespace App\Repository;

use App\Entity\TipoEmpleado;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoEmpleado|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoEmpleado|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoEmpleado[]    findAll()
 * @method TipoEmpleado[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoEmpleadoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoEmpleado::class);
    }

    // /**
    //  * @return TipoEmpleado[] Returns an array of TipoEmpleado objects
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
    public function findOneBySomeField($value): ?TipoEmpleado
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
