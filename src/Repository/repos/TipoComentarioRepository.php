<?php

namespace App\Repository;

use App\Entity\TipoComentario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoComentario|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoComentario|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoComentario[]    findAll()
 * @method TipoComentario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoComentarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoComentario::class);
    }

    // /**
    //  * @return TipoComentario[] Returns an array of TipoComentario objects
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
    public function findOneBySomeField($value): ?TipoComentario
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
