<?php

namespace App\Repository;

use App\Entity\EstadoPersona;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Estado|null find($id, $lockMode = null, $lockVersion = null)
 * @method Estado|null findOneBy(array $criteria, array $orderBy = null)
 * @method Estado[]    findAll()
 * @method Estado[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoPersonaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadoPersona::class);
    }

    // /**
    //  * @return Estado[] Returns an array of Estado objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Estado
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
