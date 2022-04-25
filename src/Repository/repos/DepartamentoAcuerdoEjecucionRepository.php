<?php

namespace App\Repository;

use App\Entity\DepartamentoAcuerdoEjecucion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DepartamentoAcuerdoEjecucion|null find($id, $lockMode = null, $lockVersion = null)
 * @method DepartamentoAcuerdoEjecucion|null findOneBy(array $criteria, array $orderBy = null)
 * @method DepartamentoAcuerdoEjecucion[]    findAll()
 * @method DepartamentoAcuerdoEjecucion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepartamentoAcuerdoEjecucionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DepartamentoAcuerdoEjecucion::class);
    }

    public function verdepartamentosAcuerdo($id)
    {
        return $this->createQueryBuilder('dp')  
           // ->select('dp.id, dp.departamentoEmpresa')                      
            ->andWhere('dp.acuerdo = :ide')
            ->setParameter('ide', $id)  
            ->getQuery()
            ->getResult()
        ;
    }











    // /**
    //  * @return DepartamentoAcuerdoEjecucion[] Returns an array of DepartamentoAcuerdoEjecucion objects
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
    public function findOneBySomeField($value): ?DepartamentoAcuerdoEjecucion
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
