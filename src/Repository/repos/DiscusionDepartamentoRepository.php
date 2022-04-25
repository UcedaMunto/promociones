<?php

namespace App\Repository;

use App\Entity\DiscusionDepartamento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DiscusionDepartamento|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiscusionDepartamento|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiscusionDepartamento[]    findAll()
 * @method DiscusionDepartamento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiscusionDepartamentoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiscusionDepartamento::class);
    }

    public function verdepartamentos($id)
    {
        return $this->createQueryBuilder('dp')  
           // ->select('dp.id, dp.departamentoEmpresa')                      
            ->andWhere('dp.discusionJefatura = :ide')
            ->setParameter('ide', $id)  
            ->getQuery()
            ->getResult()
        ;
    }
    // /**
    //  * @return DiscusionDepartamento[] Returns an array of DiscusionDepartamento objects
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
    public function findOneBySomeField($value): ?DiscusionDepartamento
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
