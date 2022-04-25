<?php

namespace App\Repository;

use App\Entity\CtlTipoContacto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CtlTipoContacto|null find($id, $lockMode = null, $lockVersion = null)
 * @method CtlTipoContacto|null findOneBy(array $criteria, array $orderBy = null)
 * @method CtlTipoContacto[]    findAll()
 * @method CtlTipoContacto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CtlTipoContactoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CtlTipoContacto::class);
    }

    // /**
    //  * @return CtlTipoContacto[] Returns an array of CtlTipoContacto objects
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
    public function findOneBySomeField($value): ?CtlTipoContacto
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
