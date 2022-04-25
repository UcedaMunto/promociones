<?php

namespace App\Repository;

use App\Entity\EstadoComentario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EstadoComentario|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoComentario|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoComentario[]    findAll()
 * @method EstadoComentario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoComentarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadoComentario::class);
    }

    // /**
    //  * @return EstadoComentario[] Returns an array of EstadoComentario objects
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
    public function findOneBySomeField($value): ?EstadoComentario
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
