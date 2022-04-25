<?php

namespace App\Repository;

use App\Entity\PreFactGruaUsa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PreFactGruaUsa|null find($id, $lockMode = null, $lockVersion = null)
 * @method PreFactGruaUsa|null findOneBy(array $criteria, array $orderBy = null)
 * @method PreFactGruaUsa[]    findAll()
 * @method PreFactGruaUsa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PreFactGruaUsaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PreFactGruaUsa::class);
    }
    
    public function getCostosGruas( $reporte) // filtra por fechas y por estado menores al que se manda como 3er parametro
    {
        $conn = $this->getEntityManager()->getConnection();
        $statement = $conn->prepare(
            "
                      
            "
        );
        $statement->execute(Array("id"=> $reporte));

        $result = $statement->fetchAll();
        return $result;
    }


    public function getReportValidationGruasPivotTable($id): ?Array
    {
        $conn = $this->getEntityManager()->getConnection();
        $statement = $conn->prepare(
            "
            select ch.monto, ch.monto as costo,  ch.correlativo, 
                case 
                    when ch.gruero_id is not null then 'extra- gruero'
                    when m.id is null and ch.gruero_id is null and e.id is null then 'NO ASIGNADO!'
                    else 'extra - empresa'
                end as tipo
                , dc.lote, dc.vin, y.nombre as yarda
                from cheques ch
                left join pre_fact_grua_usa report on report.id = ch.pre_fact_grua_usa_id
                left join grueros g on g.id = ch.gruero_id 
                left join movimiento m on 
                        m.confirmacion_pago_grua_id = ch.id 
                        or m.confirmacion_pago_storage_id = ch.id 
                        or m.confirmacion_pago_otros_id = ch.id
                left join movimiento_cheques mc on mc.cheques_id = ch.id
                left join movimiento m2 on m2.id = mc.movimiento_id
                left join companias_grua cg on cg.id = m2.compania_id
                left join envio e on e.id= m2.envio_id
                left join detalle_compra dc on dc.id = e.detalle_compra_id
                left join flete f on f.id = e.flete_id 
                left join yardas y on y.id = f.yarda_id
                where report.id = :id and m.id is null
        union        
            select A.monto, A.costo, A.correlativo, A.tipo, dc.lote, dc.vin, y.nombre as yarda from (
                select ch.monto, mgr.envio_id, ch.correlativo,'Pago de grua' as tipo, mgr.grua as costo
                    from cheques ch 
                                left join movimiento mgr on mgr.confirmacion_pago_grua_id = ch.id
                                where ch.pre_fact_grua_usa_id = :id and mgr.grua is not null
                        union 
                        select ch.monto, mstr.envio_id, ch.correlativo,'Pago de storage' as tipo, mstr.storage as costo
                            from cheques ch 
                                left join movimiento mstr on mstr.confirmacion_pago_storage_id = ch.id
                                where ch.pre_fact_grua_usa_id = :id and mstr.grua is not null
                        union 
                        select ch.monto, motros.envio_id, ch.correlativo,'Otros pago' as tipo, motros.otros_costos_grua as costo
                            from cheques ch 
                                left join movimiento motros on motros.confirmacion_pago_otros_id = ch.id
                                where ch.pre_fact_grua_usa_id = :id and motros.grua is not null
                    ) A
                left join envio e on e.id= A.envio_id
                left join detalle_compra dc on dc.id = e.detalle_compra_id
                left join flete f on f.id = e.flete_id 
                left join yardas y on y.id = f.yarda_id
            "
            );
        $statement->execute(Array("id"=>$id));
        $result = $statement->fetchAll();
        return $result;
    }

    public function getReportValidationGruas($id): ?Array
    {
        $conn = $this->getEntityManager()->getConnection();
        $statement = $conn->prepare( //(m.grua + m.storage + m.otros_costos_grua) as total
            "
            select * from (
                select 	c.id as 		reporte,
                        mo.nombre as 	modelo,
                        cg.nombre as 	compania ,
                        c1.id as 		g,
                        c2.id as 		s, 
                        c3.id as 		o,
                        m.id as 		movimiento,
                        dc.anio,
                        ma.nombre as 	marca ,
                        dc.lote ,
                        dc.vin ,
                        m.grua,
                        m.storage,
                        m.otros_costos_grua, c1.validacion_gruas, c2.validacion_storage, c3.validacion_otros,
                        'error' as total, y.nombre as yarda, ch.correlativo
                        ,c1.pre_fact_grua_usa_id as confirmacionPagoGruaIdReport
                        ,c2.pre_fact_grua_usa_id  as confirmacionPagoStorageIdReport
                        ,c3.pre_fact_grua_usa_id  as confirmacionPagoOtrosIdReport
                        ,concat( coalesce(c1.correlativo, 'no '),' - ', coalesce(g1.nombre, 'EMP'),' - ', coalesce(g1.nombre, cg.nombre, 'sd')) as infoCheques1
                        ,concat( coalesce(c2.correlativo, 'no '),' - ', coalesce(g2.nombre, 'EMP'),' - ', coalesce(g2.nombre, cg.nombre, 'sd')) as infoCheques2
                        ,concat( coalesce(c3.correlativo, 'no ') ,' - ', coalesce(g3.nombre, 'EMP',' - ', coalesce(g3.nombre, cg.nombre, 'sd'))) as infoCheques3
                    from pre_fact_grua_usa c
                        left join cheques ch on ch.pre_fact_grua_usa_id = c.id and ch.id is not null 
                        left join movimiento m on 
                                m.confirmacion_pago_grua_id = ch.id 
                                or m.confirmacion_pago_storage_id = ch.id 
                                or m.confirmacion_pago_otros_id = ch.id 
                        left join envio e on e.id = m.envio_id 
                        left join detalle_compra dc on dc.id = e.detalle_compra_id 
                        left join modelo mo on mo.id = dc.modelo_id 
                        left join marca ma on ma.id = mo.marca_id 
                        left join flete f on f.id = e.flete_id 
                        left join yardas y on y.id = f.yarda_id
                        left join cheques c1 on c1.id = m.confirmacion_pago_grua_id
                            left join grueros g1 on g1.id= c1.gruero_id 
                        left join cheques c2 on c2.id = m.confirmacion_pago_storage_id
                            left join grueros g2 on g2.id= c2.gruero_id 
                        left join cheques c3 on c3.id = m.confirmacion_pago_otros_id
                            left join grueros g3 on g3.id= c3.gruero_id 
                        left join companias_grua cg on cg.id = m.compania_id
                    where c.id = :id and m.id is not null
                ) X group by movimiento
            "
            );
        $statement->execute(Array("id"=>$id));
        $result = $statement->fetchAll();
        return $result;
    }

    public function getReportPagosExtraOrdinarios($id): ?Array //esta consulta tiene mucha relacion con getChequesExtrasAndNoAsignados es semejante si la logica cambia tambien es necesario cambiar esta otra
    {
        $conn = $this->getEntityManager()->getConnection();
        $statement = $conn->prepare(
            "
            select m2.id as movimiento, ch.id, ch.correlativo, ch.descripcion_cheque
                ,ch.monto, ch.saldo_favor_generado, g.nombre as gruero, cg.nombre as compania, ch.validacion_cheque_especial
                from cheques ch
                left join pre_fact_grua_usa report on report.id = ch.pre_fact_grua_usa_id
                left join grueros g on g.id = ch.gruero_id 
                left join movimiento m on 
                        m.confirmacion_pago_grua_id = ch.id 
                        or m.confirmacion_pago_storage_id = ch.id 
                        or m.confirmacion_pago_otros_id = ch.id
                left join movimiento_cheques mc on mc.cheques_id = ch.id
                left join movimiento m2 on m2.id = mc.movimiento_id
                left join companias_grua cg on cg.id = m2.compania_id
                where report.id = :id and m.id is null
            "
            );
        $statement->execute(Array("id"=>$id));
        $result = $statement->fetchAll();
        return $result;
    }

    public function getChequesExtrasAndNoAsignados($id): ?Array
    {
        $conn = $this->getEntityManager()->getConnection();
        $statement = $conn->prepare(
            "
            select 'NO VALIDO' as lote, m2.id as movimiento, ch.id, ch.correlativo, ch.descripcion_cheque
                ,ch.monto, ch.saldo_favor_generado, g.nombre as gruero, cg.nombre as compania, ch.validacion_cheque_especial
                from cheques ch
                left join pre_fact_grua_usa report on report.id = ch.pre_fact_grua_usa_id
                left join grueros g on g.id = ch.gruero_id 
                left join movimiento m on 
                        m.confirmacion_pago_grua_id = ch.id 
                        or m.confirmacion_pago_storage_id = ch.id 
                        or m.confirmacion_pago_otros_id = ch.id
                left join movimiento_cheques mc on mc.cheques_id = ch.id
                left join movimiento m2 on m2.id = mc.movimiento_id
                left join envio e on e.id = m2.envio_id
                left join detalle_compra dc on dc.id = e.detalle_compra_id 
                left join companias_grua cg on cg.id = m2.compania_id
                where report.id =:id and m.id is null and m2.id is null
            UNION
            select group_concat(dc.lote) as lotes, m2.id as movimiento, ch.id, ch.correlativo, ch.descripcion_cheque
                ,ch.monto, ch.saldo_favor_generado, g.nombre as gruero, cg.nombre as compania, ch.validacion_cheque_especial
                from cheques ch
                left join pre_fact_grua_usa report on report.id = ch.pre_fact_grua_usa_id
                left join grueros g on g.id = ch.gruero_id 
                left join movimiento m on 
                        m.confirmacion_pago_grua_id = ch.id 
                        or m.confirmacion_pago_storage_id = ch.id 
                        or m.confirmacion_pago_otros_id = ch.id
                left join movimiento_cheques mc on mc.cheques_id = ch.id
                left join movimiento m2 on m2.id = mc.movimiento_id
                left join envio e on e.id = m2.envio_id
                left join detalle_compra dc on dc.id = e.detalle_compra_id 
                left join companias_grua cg on cg.id = m2.compania_id
                where report.id =:id and m.id is null and m2.id is not null group by e.id
            "
        );
        $statement->execute(Array("id"=>$id));
        $result = $statement->fetchAll();
        return $result;
    }

    // /**
    //  * @return PreFactGruaUsa[] Returns an array of PreFactGruaUsa objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder("p")
            ->andWhere("p.exampleField = :val")
            ->setParameter("val", $value)
            ->orderBy("p.id", "ASC")
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PreFactGruaUsa
    {
        return $this->createQueryBuilder("p")
            ->andWhere("p.exampleField = :val")
            ->setParameter("val", $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
