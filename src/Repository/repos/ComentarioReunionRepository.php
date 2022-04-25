<?php

namespace App\Repository;

use App\Entity\ComentarioReunion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ComentarioReunion|null find($id, $lockMode = null, $lockVersion = null)
 * @method ComentarioReunion|null findOneBy(array $criteria, array $orderBy = null)
 * @method ComentarioReunion[]    findAll()
 * @method ComentarioReunion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComentarioReunionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ComentarioReunion::class);
    }
    public function DiscusionJefaturaComentario($discusion): ?Array
    {
        return $this->createQueryBuilder('c')
            ->select(array('c.id','c.tituloComent', 'c.fecha', 'c.mensaje',  'ue.usuario', 'rp.id as resp', 'dj.id as disre' ) )
            ->leftjoin('c.usuarioEmpleado', 'ue')
            ->leftjoin('c.respuesta', 'rp')
            ->leftjoin('c.discusionJefatura', 'dj')
            ->andWhere('c.discusionJefatura = :discusion')
            ->setParameter('discusion', $discusion)
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getArrayResult()
        ;
    }

    // /**
    //  * @return ComentarioReunion[] Returns an array of ComentarioReunion objects
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
    public function findOneBySomeField($value): ?ComentarioReunion
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
