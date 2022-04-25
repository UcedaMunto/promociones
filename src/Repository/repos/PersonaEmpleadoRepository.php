<?php

namespace App\Repository;

use App\Entity\PersonaEmpleado;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PersonaEmpleado|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonaEmpleado|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonaEmpleado[]    findAll()
 * @method PersonaEmpleado[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonaEmpleadoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonaEmpleado::class);
    }

    // /**
    //  * @return PersonaEmpleado[] Returns an array of PersonaEmpleado objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PersonaEmpleado
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
