<?php

namespace App\Repository;

use App\Entity\Acuerdo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Acuerdo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Acuerdo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Acuerdo[]    findAll()
 * @method Acuerdo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AcuerdoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Acuerdo::class);
    }
    
    //select user.id , dp.nombre , dp.apellido from usuario_empleado user , persona_empleado pe , datos_persona dp 
        //where user.empleado_id = pe.id and pe.datos_id = dp.id 

    // /**
    //  * @return Acuerdo[] Returns an array of Acuerdo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Acuerdo
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
