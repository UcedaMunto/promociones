<?php

namespace App\Repository;

use App\Entity\Movimiento;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Movimiento|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movimiento|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movimiento[]    findAll()
 * @method Movimiento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovimientoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movimiento::class);
    }
    public function getMovimientosFromTrack($envio): ?Array
    {
        return $this->createQueryBuilder('c')
            ->select(
                array(
                    'c.fechaRecogida','est.nombre'
                ) 
            )
            ->leftjoin('c.estado', 'est')
            ->Where('c.envio = :envio')
            ->setParameter('envio', $envio)
            ->getQuery()
            ->getArrayResult()
        ;
    }

    public function findIntervalDateFromPagosGrua( DateTime $fechaInicial, DateTime $fechaFinal )
    {
        return $this->createQueryBuilder('f')
            ->select(
                array('f.id as movimiento', 'e.id as envio', 'dc.lote', 'dc.vin',
                    'c.nombre as compania','tp.nombre as flete', 'y.nombre as yarda',
                    'co.compraEstado as estado', 'dc.lote', 'f.linkCentralDispatch',
                    'eMov.nombre as estadoMov'
                    )
                )
            ->leftJoin('f.compania', 'c')
            ->leftJoin('f.envio', 'e')
            ->leftJoin('e.detalleCompra', 'dc')
            ->leftjoin('dc.compra', 'co')
            ->leftjoin('e.flete', 'fl')
            ->leftjoin('fl.tipo', 'tp')
            ->leftjoin('fl.yarda', 'y')
            ->leftjoin('f.estado', 'eMov')
            ->andWhere('dc.TrackP1Ingreso >= :fechaInicial')
            ->andWhere('dc.TrackP1Ingreso <= :fechaFinal')
            ->andWhere('co.compraEstado > 3')
            ->setParameter('fechaInicial', $fechaInicial )
            ->setParameter('fechaFinal',  $fechaFinal )
            ->orderBy('f.id', 'DESC')
            ->getQuery()
            ->getArrayResult()
        ;
    }

    

    /**
    * @return Movimiento[] Returns an array of Movimiento objects
     */
    public function getMovimientosFromPrefactGrua($idPrefactGrua)
    {
        return $this->createQueryBuilder('m')
            ->leftJoin('m.confirmacionPagoGrua',  'p1')
            ->leftJoin('m.confirmacionPagoStorage',  'p2')
            ->leftJoin('m.confirmacionPagoOtros',  'p3')
            ->leftJoin('m.chequesExtra',  'p4')
            ->andWhere('p1.preFactGruaUsa= :report or p2.preFactGruaUsa= :report or p3.preFactGruaUsa= :report or p4.preFactGruaUsa= :report')
            ->setParameter('report', $idPrefactGrua)
            ->orderBy('m.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }



    public function getChequesExtrasFromReport($idReporte)
    {
        return $this->createQueryBuilder('m')
            ->select(
                array('ch.id as idCheque', 'ch.monto', 'ch.saldoFavorGenerado')
                )
            ->leftjoin('m.chequesExtra', 'ch')
            ->leftjoin('ch.preFactGruaUsa', 'informe')
            ->andWhere('informe.id = :idReporte')
            ->setParameter('idReporte', $idReporte)
            ->getQuery()
            ->getArrayResult()
        ;
    }
    


    // /**
    //  * @return Movimiento[] Returns an array of Movimiento objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Movimiento
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
