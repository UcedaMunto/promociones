<?php

namespace App\Repository;

use App\Entity\DepartamentoEmpresa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DepartamentoEmpresa|null find($id, $lockMode = null, $lockVersion = null)
 * @method DepartamentoEmpresa|null findOneBy(array $criteria, array $orderBy = null)
 * @method DepartamentoEmpresa[]    findAll()
 * @method DepartamentoEmpresa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepartamentoEmpresaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DepartamentoEmpresa::class);
    }


    public function findAllArray (): ?Array
    {
        return $this->createQueryBuilder('c')
        ->select(array('c.id', 'c.nombre'))
        ->getQuery()
        ->getResult();
    }

    // /**
    //  * @return DepartamentoEmpresa[] Returns an array of DepartamentoEmpresa objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DepartamentoEmpresa
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
