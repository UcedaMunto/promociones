<?php

namespace App\Repository;

use App\Entity\Contenedor;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Contenedor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contenedor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contenedor[]    findAll()
 * @method Contenedor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContenedorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contenedor::class);
    }

    /**
    * @return Envio[] Returns an array of Envio objects
    */
    public function findIntervalDate( DateTime $fechaInicial, DateTime $fechaFinal )
    {
        return $this->createQueryBuilder('e')
            ->leftJoin('e.dockreceipt', 'd')
            ->andWhere('d.creacion >= :fechaInicial')
            ->andWhere('d.creacion <= :fechaFinal')
            ->setParameter('fechaInicial', $fechaInicial )
            ->setParameter('fechaFinal',  $fechaFinal )
            ->orderBy('e.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getPreciosAutos( $contenedor) // filtra por fechas y por estado menores al que se manda como 3er parametro
    {
        $conn = $this->getEntityManager()->getConnection();
        $statement = $conn->prepare(
            "
            select  A.id, sum(A.grua_precio) as totalPgrua,sum(A.precio_flete) as totalPFlete,sum(A.precio_bl) as totalPBl, sum(A.storage) as totalStorage, sum(A.notaria) as totalNotaria, sum(A.otros) as totalOtros  from (
                select c.id , e.grua_precio , e.precio_flete , e.precio_bl, ec.notaria, ec.storage, ec.otros from contenedor c
                left join envio_contenedor ec on ec.contenedor_id = c.id
                left join envio e on e.id = ec.envio_id 
                where c.id= :id
            ) A group by A.id            
                "
            );
        $statement->execute(Array('id'=>$contenedor));

        $result = $statement->fetchAll();
        return $result;
    }

    public function getCostosAutos( $contenedor ) // filtra por fechas y por estado menores al que se manda como 3er parametro
    {
        $conn = $this->getEntityManager()->getConnection();
        $statement = $conn->prepare(
            "
            select  A.id, sum(A.costo_flete) as totalCflete,sum(A.movimientos) as totalCGrua, sum(A.notaria_costo) as totalCNotaria, sum(A.otros) as totalCOtros, A.costo_descarga as totalCDescarga, A.costo_envio_documentos as totalCDocumentos, 
            A.costo_envio_pago as totalCEPago, A.otros_costos as totalCOC, sum(A.bl) as totalCBl, A.costo_comision as totalCComision, A.costo_contenedor_yarda as totalCCYarda, A.costo_terrestre as totalCTerrestre, A.costo_yarda as totalCYarda,
            A.otros_costos_flete as totalOCFlete 
            from (
                select c.id, e.costo_flete, (sum(m.grua)+sum(m.storage)+IFNULL(sum(m.otros_costos_grua), 0)) as movimientos, ec.notaria_costo, ec.otros,
                c.costo_descarga, c.costo_envio_documentos, c.costo_envio_pago, c.otros_costos, sum(e.precio_bl) as bl, c.costo_comision, c.costo_contenedor_yarda, c.costo_terrestre, c.costo_yarda, c.otros_costos_flete 
                 from contenedor c
                left join envio_contenedor ec on ec.contenedor_id = c.id
                left join envio e on e.id = ec.envio_id
                left join movimiento m on e.id  = m.envio_id 
                where c.id= :id group by e.id 
            ) A group by A.id            
            "
            );
        $statement->execute(Array('id'=>$contenedor));

        $result = $statement->fetchAll();
        return $result;
    }

    /*
    * @return Contenedor[] Returns an array of Contenedor objects
    
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder ('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }*/

    // /**
    //  * @return Contenedor[] Returns an array of Contenedor objects
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
    public function findOneBySomeField($value): ?Contenedor
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
