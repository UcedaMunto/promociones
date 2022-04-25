<?php

namespace App\Repository;

use App\Entity\Envio;
use App\Entity\Yardas;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Envio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Envio|null findOneBy(array $criteria, array $orderBy = null)
 * @method Envio[]    findAll()
 * @method Envio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnvioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Envio::class);
    }

    /**
    * @return Envio[] Returns an array of Envio objects
    */
    public function findIntervalDateByNameFact( DateTime $fechaInicial, DateTime $fechaFinal, String $nombre )
    {
        return $this->createQueryBuilder('e')
            ->leftJoin('e.detalleCompra', 'dc')
            ->leftjoin('dc.compra', 'co')
            ->leftjoin('co.importador', 'impo')
            ->andWhere('dc.TrackP1Ingreso >= :fechaInicial')
            ->andWhere('dc.TrackP1Ingreso <= :fechaFinal')
            ->andWhere('impo.nombreFactura LIKE :nombre')
            ->setParameter('fechaInicial', $fechaInicial )
            ->setParameter('fechaFinal',  $fechaFinal )
            ->setParameter('nombre',  "%".$nombre."%" )
            ->orderBy('e.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    /**
    * @return Envio[] Returns an array of Envio objects
    */
    public function findIntervalDate( DateTime $fechaInicial, DateTime $fechaFinal, $menorEstado ) // filtra por fechas y por estado menores al que se manda como 3er parametro
    {
        return $this->createQueryBuilder('e')
            ->leftJoin('e.detalleCompra', 'dc')
            ->leftjoin('dc.compra', 'co')
            ->andWhere('co.compraEstado< :menorEstado') // solo las compras menores a 4 deben de poder ser marcadas en yarda 
            ->andWhere('dc.TrackP1Ingreso >= :fechaInicial')
            ->andWhere('dc.TrackP1Ingreso <= :fechaFinal')
            ->setParameter('fechaInicial', $fechaInicial )
            ->setParameter('fechaFinal',  $fechaFinal )
            ->setParameter('menorEstado',  $menorEstado )
            ->orderBy('e.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    * 
    */
    public function findIntervalDateOptimizada( 
            DateTime $fechaInicial, DateTime $fechaFinal,
            $estadoInicial, $estadoFinal,
            $indexInicial, $rango,
            $lote, $vin 
    ) // filtra por fechas y por estado menores al que se manda como 3er parametro
    {
        
        $conn = $this->getEntityManager()->getConnection();
        $filtroLoteVin="where ( dc.lote = :lote or dc.vin= :vin)";
        $statement = $conn->prepare(
            "
            select  e.id as envio_id, 	dc.id as detalle_compra_id, c.id as compra_id,
                dc.lote,			dc.vin, 					ya.nombre, 		
                adu.nombre, 		c.compra_estado, 			'' as acciones, 
                c.fecha_factura_cero  as fecha_solvente,		tc.nombre,
                dp.nombre as importador, 	dp2.nombre as cliente, mo.nombre as modelo
                from envio e 
                left join detalle_compra dc 
                    ON e.detalle_compra_id = dc.id 
                left join compra c 
                    ON dc.compra_id= c.id
                left join tipo_compra tc
                    ON c.tipo_compra_id = tc.id
                left join persona_cliente pc
                    ON c.persona_cliente_id = pc.id
                left join importador imp
                    on c.importador_id = imp.id or imp.id is null
                left join datos_persona dp 
                    on pc.datos_id = dp.id or dp.id is null
                left join datos_persona dp2 
                    on imp.persona_cliente_id= dp2.id or dp2.id is null
                left join flete fle
                    on e.flete_id = fle.id or fle.id is null
                left join yardas ya 
                    on fle.yarda_id = ya.id
                left join aduana adu
                    on e.aduana_id = adu.id or adu.id is null
                left join modelo mo
                    on mo.id = dc.modelo_id or mo.id is null
                order by e.id desc
                LIMIT  ".$rango." OFFSET  ".$indexInicial
            );
        
        $statement->execute(
            //Array('rango'=>$, 'pagina'=>$)
        );
        $result = $statement->fetchAll();
        return $result;
    }

    /*
    public function getData( ) // filtra por fechas y por estado menores al que se manda como 3er parametro
    {
        $conn = $this->getEntityManager()->getConnection();
        $statement = $conn->prepare(
            'select a.* from (
                select * from persona_empleado where id> :id
                ) a
                '
            );
        $statement->execute(Array('id'=>23));

        $result = $statement->fetchAll();
        return $result;
    }/*

    
    /*
    public function findIntervalDateFromPagosGrua( DateTime $fechaInicial, DateTime $fechaFinal )
    {
        return $this->createQueryBuilder('e')
            ->leftJoin('e.detalleCompra', 'dc')
            ->leftjoin('dc.compra', 'co')
            ->andWhere('dc.TrackP1Ingreso >= :fechaInicial')
            ->andWhere('dc.TrackP1Ingreso <= :fechaFinal')
            ->andWhere('co.compraEstado > 4')
            ->setParameter('fechaInicial', $fechaInicial )
            ->setParameter('fechaFinal',  $fechaFinal )
            ->orderBy('e.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }/*

    /**
    * @return Envio[] Returns an array of Envio objects
    */
    public function findFechaFacturaCero( DateTime $fechaInicial  )
    {
        return $this->createQueryBuilder('e')
            ->leftJoin('e.detalleCompra', 'dc')
            ->leftjoin('dc.compra', 'co')
            ->andWhere('co.fechaFacturaCero is null')
            ->andWhere('dc.TrackP1Ingreso >= :fechaInicial')
            ->setParameter('fechaInicial', $fechaInicial )
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }


    public function findOneByVinLote( $vin, $lote  ): ?Envio
    {
        $rresultado= $this->createQueryBuilder('e')
            ->leftJoin('e.detalleCompra', 'dc')
            ->Where('dc.lote = :lote')
            ->setParameter('lote', $lote )
            ->getQuery()
            ->getOneOrNullResult()
            ;
        
        if($rresultado==null){
            $rresultado= $this->createQueryBuilder('e')
            ->leftJoin('e.detalleCompra', 'dc')
            ->Where('dc.vin = :vin')
            ->setParameter('vin', $vin )
            ->getQuery()
            ->getOneOrNullResult()
            ; 
        }
        return $rresultado;
    }

    
    public function trackingEnvio($vin, $lote): ?Array
    {
        return $this->createQueryBuilder('c')
            ->select(
                array('dc.vin', 'com.compraEstado', 'dc.TrackP1Ingreso'	,'dc.TrackP2Recogida'	,'dc.TrackP3FotosGrua',
                        'dc.TrackP4InvYardaa'	,'dc.TrackP5TituloFotos', 'dock.creacion as TrackP5_dock',
                        'co.fechaEnbarcacion as TrackP5_dock_embarcacion','dc.TrackP6Partida'	,'dc.TrackP7Arribo',
                        'dc.TrackP8Desembarcado'	,'dc.TrackP9Aduana'	,'dc.TrackP10Descargado'	,'dc.TrackP11Cobrado',
                ) 
            )
            ->leftjoin('c.detalleCompra', 'dc')
            ->leftjoin('dc.compra', 'com')
            ->leftjoin('c.envioContedor', 'ec')
            ->leftjoin('ec.contenedor', 'co')
            ->leftjoin('co.dockreceipt', 'dock')
            ->Where('dc.lote = :lote or dc.vin = :vin')
            ->setParameter('lote', $lote )
            ->setParameter('vin', $vin )
            ->getQuery()
            ->getArrayResult()
        ;
    }

    

    /**
    * @return Envio[] Returns an array of Envio objects
    */
    public function findIntervalDateAndYarda( DateTime $fechaInicial, DateTime $fechaFinal, Yardas $yarda )
    {
        return $this->createQueryBuilder('e')
            ->leftJoin('e.detalleCompra', 'dc')
            ->leftjoin('dc.compra', 'co')
            ->leftjoin('e.flete', 'fle')
            ->andWhere('dc.TrackP1Ingreso >= :fechaInicial')
            ->andWhere('dc.TrackP1Ingreso <= :fechaFinal')
            ->andWhere('fle.yarda = :yarda')
            ->setParameter('fechaInicial', $fechaInicial )
            ->setParameter('fechaFinal',  $fechaFinal )
            ->setParameter('yarda',  $yarda )
            ->orderBy('e.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Envio
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
