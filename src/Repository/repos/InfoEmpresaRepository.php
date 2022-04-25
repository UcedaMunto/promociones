<?php

namespace App\Repository;

use App\Entity\InfoEmpresa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InfoEmpresa|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfoEmpresa|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfoEmpresa[]    findAll()
 * @method InfoEmpresa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfoEmpresaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InfoEmpresa::class);
    }

    // /**
    //  * @return InfoEmpresa[] Returns an array of InfoEmpresa objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InfoEmpresa
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
