<?php

namespace App\Repository;

use App\Entity\Cheques;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cheques|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cheques|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cheques[]    findAll()
 * @method Cheques[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChequesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cheques::class);
    }


    public function validarAsignacionesCheques(Array $idCheques){
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->where('u.role IN (:role)')
            ->setParameter("cheques",$idCheques)
            ->getQuery()
            ->getArrayResult()
        ;
    }

    public function findMostrarCheques($fechaInicial, $fechaFinal): array
    {
        return $this->createQueryBuilder('c')
            ->select(array('c.id', 'c.correlativo', 'c.monto', 'c.creacion', 'p.nombre', 'c.saldoFavorGenerado', 'c.descripcionCheque'))
            ->leftjoin('c.preFactGruaUsa', 'p')
            ->orderBy('c.id', 'DESC')
            ->andWhere('c.creacion >= :fechaInicio and c.creacion<= :fechaFinal ')
            ->setParameter('fechaInicio', $fechaInicial )
            ->setParameter('fechaFinal',  $fechaFinal )
            ->getQuery()
            ->getArrayResult()
        ;
    }


    // /**
    //  * @return Cheques[] Returns an array of Cheques objects
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
    public function findOneBySomeField($value): ?Cheques
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
