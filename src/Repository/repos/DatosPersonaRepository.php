<?php

namespace App\Repository;

use App\Entity\DatosPersona;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use function Symfony\Component\DependencyInjection\Loader\Configurator\expr;

/**
 * @method DatosPersona|null find($id, $lockMode = null, $lockVersion = null)
 * @method DatosPersona|null findOneBy(array $criteria, array $orderBy = null)
 * @method DatosPersona[]    findAll()
 * @method DatosPersona[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DatosPersonaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DatosPersona::class);
    }


    public function buscarSiguienteId()
    {
        return $this->createQueryBuilder('d')            
            ->orderBy('d.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }


    public function buscarDuiActual($dui,$id)
    {
        return $this->createQueryBuilder('d')            
            
            ->setParameter('dui', $dui)
            ->setParameter('id', $id)
            ->andWhere('d.dui = :dui')
            ->andWhere('d.id <> :id')
            ->getQuery()
            ->getResult()
        ;
    }

    public function buscarNitActual($nit,$id)
    {
        return $this->createQueryBuilder('d')            
            
            ->setParameter('nit', $nit)
            ->setParameter('id', $id)
            ->andWhere('d.nit = :nit')
            ->andWhere('d.id <> :id')
            ->getQuery()
            ->getResult()
        ;
    }

    public function buscarIvaActual($iva,$id)
    {
        return $this->createQueryBuilder('d')            
            
            ->setParameter('iva', $iva)
            ->setParameter('id', $id)
            ->andWhere('d.registroIva = :iva')
            ->andWhere('d.id <> :id')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return DatosPersona[] Returns an array of DatosPersona objects
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
    public function findOneBySomeField($value): ?DatosPersona
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
