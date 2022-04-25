<?php

namespace App\Repository;

use App\Entity\FotosVehiculo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FotosVehiculo|null find($id, $lockMode = null, $lockVersion = null)
 * @method FotosVehiculo|null findOneBy(array $criteria, array $orderBy = null)
 * @method FotosVehiculo[]    findAll()
 * @method FotosVehiculo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FotosVehiculoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FotosVehiculo::class);
    }

    public function findYardaEnvio($envio): ?Array
    {
        return $this->createQueryBuilder('c')
            ->select(
                array('c.id', 'c.creacion', 'c.name','c.extension') 
            )
            ->leftjoin('c.detalleCompra', 'dc')
            ->leftjoin('dc.envio', 'env')
            ->Where('env.id = :envio and c.tipo=2')
            ->setParameter('envio', $envio )
            ->getQuery()
            ->getArrayResult()
        ;
    }
    public function findGruas($envio, $vin, $lote): ?Array
    {
        
        return $this->createQueryBuilder('c')
            ->select(
                array('c.id', 'c.creacion', "CONCAT(carp.nombre,'/',c.name) as name",'c.extension') 
            )
            ->leftjoin('c.detalleCompra', 'dc')
            ->leftjoin('dc.envio', 'env')
            ->leftjoin('c.carpeta', 'carp')
            ->Where('(env.id = :envio or dc.lote= :lote or dc.vin= :vin or carp.nombre=:vin or carp.nombre=:lote) and c.tipo=1')
            ->setParameter('envio', $envio )
            ->setParameter('vin', $vin )
            ->setParameter('lote', $lote )
            ->getQuery()
            ->getArrayResult()
        ;
    }

    // /**
    //  * @return FotosVehiculo[] Returns an array of FotosVehiculo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FotosVehiculo
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
