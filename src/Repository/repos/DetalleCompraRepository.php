<?php

namespace App\Repository;

use App\Entity\DetalleCompra;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DetalleCompra|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetalleCompra|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetalleCompra[]    findAll()
 * @method DetalleCompra[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetalleCompraRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetalleCompra::class);
    }

    // /**
    //  * @return DetalleCompra[] Returns an array of DetalleCompra objects
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

    public function findOneByLoteVin($lote, $vin): ?DetalleCompra {
        return $this->createQueryBuilder('d')
            ->andWhere('d.lote = :lote')
            ->orWhere('d.vin = :vin')
            ->setParameter('lote', $lote)
            ->setParameter('vin', $vin)
            ->orderBy('d.id', 'ASC')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function getListaFromPuertoAduana($yarda, $aduana, $contenedor): ?Array
    {
        //$fechaInicio=new \DateTime('NOW');

        return $this->createQueryBuilder('c')
                ->select(
                    array('e.id', 'c.lote', 'c.vin', 'mo.nombre as modelo', 'c.TrackP1Ingreso as creacion','ma.nombre as marca',
                    'c.subModelo as subModelo','c.pesoKilogramos as pesoKilogramos','c.aes as aes','c.extras as extras',  ))
                ->addSelect('(CASE  
                             WHEN c.lote IS NULL OR c.lote=:vacio THEN c.vin 
                             ELSE c.lote
                            END) as identificador')
                ->leftjoin('c.compra', 'co')
                ->leftjoin('c.envio', 'e')
                ->leftjoin('e.envioContedor', 'ec')
                ->leftjoin('ec.contenedor', 'conte')
                ->leftjoin('e.flete', 'f')
                ->leftjoin('c.modelo', 'mo')
                ->leftjoin('mo.marca', 'mar')
                ->leftjoin('mo.marca', 'ma')
                ->Where('(f.yarda = :yarda and 
                            ec.id is null and 
                            e.aduana = :aduana 
                            and (co.compraEstado = 4 or co.compraEstado = 5))')
                //en caso de que sea una compra de grua interna esta no tiene destino y por tanto no debe aparecer en el dokreceip
                ->setParameter('vacio', '')
                ->setParameter('yarda', $yarda)
                ->setParameter('aduana', $aduana)
                ->orderBy('c.id', 'ASC')
                //->setMaxResults(10)
            ->getQuery()
            ->getArrayResult()
        ;
    }

    
    public function findOneRepetido($vin, $lote)//retorna una coleccion de los objetoc que cumplen
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.vin = :vin or d.lote= :lote')
            ->setParameter('vin', $vin)
            ->setParameter('lote', $lote)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneRepetidoEdit($vin, $lote, $id): ?DetalleCompra
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.id != :id and (d.vin = :vin or d.lote= :lote)') //excluir la misma entidad que se esta editando
            ->setParameter('vin', $vin)
            ->setParameter('lote', $lote)
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    
}
