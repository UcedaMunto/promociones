<?php

namespace App\Repository;

use App\Entity\AgendaRevision;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @method AgendaRevision|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgendaRevision|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgendaRevision[]    findAll()
 * @method AgendaRevision[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgendaRevisionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgendaRevision::class);
    }

    public function agendadasForUserArray($encargado ): ?Array
    {
        $fechaInicio=new \DateTime('NOW');
        return $this->createQueryBuilder('c')
                ->select(array('c.fechaCreacion', 'c.id', 'c.descripcion', 'x.id as comentario' ) )
                ->leftjoin('c.comentario', 'x')
                ->andWhere('c.fechaInicio <= :fechaActual')
                ->andwhere("DATE_ADD( c.fechaInicio , c.duracionRecordatorio, 'DAY') >= :fechaActual")
                ->andWhere('c.estado = :estado')
                ->andWhere('c.encargado = :encargado')
                ->setParameter('encargado', $encargado)
                ->setParameter('estado', 1)
                ->setParameter('fechaActual', $fechaInicio)
                ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getArrayResult()
        ;
        
    }

    
    /**
    * @return AgendaRevision[] Returns an array of AgendaRevision objects
    */
    public function tareasEmpleadoPendientesYnoResueltas($usuarioId)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.encargado = :usuarioId')
            ->andWhere('a.estado=1 or a.estado=3')
            ->andWhere('a.fechaCreacion > :fechaInicial')
            ->setParameter('usuarioId', $usuarioId)
            ->setParameter('fechaInicial', new \DateTime('-6 MONTH')) 
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return AgendaRevision[] Returns an array of AgendaRevision objects
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
    public function findOneBySomeField($value): ?AgendaRevision
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
