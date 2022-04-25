<?php

namespace App\Repository;

use App\Entity\PersonaCliente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PersonaCliente|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonaCliente|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonaCliente[]    findAll()
 * @method PersonaCliente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonaClienteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonaCliente::class);
    }
    public function findIndexAll(){
        return $this->createQueryBuilder('p')
            ->select('p.id', 'p.tokenRegistro','d.nombre','d.apellido','ePc.nombre as estado','d.correo1','d.dui','d.celular','pa.nombre as pais','d.telefono',
                        'd.nit','usu.usuario','d.documentos','d.documentos2','d.documentos3', 'tpCl.nombre as tipoCliente', 'tpCl.id as idTc',
                        "GROUP_CONCAT(imp.buyer SEPARATOR ' /') as importadores")
            ->leftJoin('p.datos','d')
            ->leftJoin('p.estado','ePc')
            ->leftJoin('p.usuario','usu')
            ->leftJoin('p.tipoCliente','tpCl')
            ->leftJoin('d.departamento','dep')
            ->leftJoin('dep.pais','pa')
            ->leftJoin('p.importador','imp')
            ->andWhere('p.tipoCliente < 5')
            ->groupBy('p.id')
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getArrayResult()
        ;
    }

    public function findIndexAllEmp(){
        return $this->createQueryBuilder('p')
            ->select('p.id', 'p.tokenRegistro','d.nombre','d.apellido','ePc.nombre as estado','d.correo1','d.dui','d.celular','pa.nombre as pais','d.telefono',
                        'd.nit','usu.usuario','d.documentos','d.documentos2','d.documentos3', 'tpCl.nombre as tipoCliente', 'tpCl.id as idTc',
                        "GROUP_CONCAT(imp.buyer SEPARATOR ' /') as importadores")
            ->leftJoin('p.datos','d')
            ->leftJoin('p.estado','ePc')
            ->leftJoin('p.usuario','usu')
            ->leftJoin('p.tipoCliente','tpCl')
            ->leftJoin('d.departamento','dep')
            ->leftJoin('dep.pais','pa')
            ->leftJoin('p.importador','imp')
            ->andWhere('p.tipoCliente > 4')
            ->groupBy('p.id')
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getArrayResult()
        ;
    }


    // /**
    //  * @return PersonaCliente[] Returns an array of PersonaCliente objects
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
    public function findOneBySomeField($value): ?PersonaCliente
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
