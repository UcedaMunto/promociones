<?php

namespace App\Repository;

use App\Entity\Comentarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comentarios|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comentarios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comentarios[]    findAll()
 * @method Comentarios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComentariosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comentarios::class);
    }

    public function ComentariosCreadosUsuarioArray($autor, $estado): ?Array
    {
        return $this->createQueryBuilder('c')
            ->select(array('c.fechaCreacion', 'c.id', 'c.mensaje', 'c.titulo', 'x.id as envio' ) )
            ->leftjoin('c.compra', 'o')
            ->leftjoin('o.detalleCompra', 'r')
            ->leftjoin('c.contenedor', 't')
            ->leftjoin('r.envio', 'x')
            ->andWhere('c.autor = :autor')
            ->andWhere('c.estado != :estado')
            ->andWhere('c.estado != :estadoMal')
            ->andWhere('c.tipo != :tipo')
            ->andWhere('c.respuestas IS NULL')
            ->andWhere('t.id IS NULL')
            ->setParameter('autor', $autor)
            ->setParameter('estado', $estado)
            ->setParameter('tipo', 5)
            ->setParameter('estadoMal', 8)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getArrayResult()
        ;
    }


    /**
    *   @return Comentarios[] Returns an array of DepartamentoEmpresa objects
    *  
    */
    public function ComentariosPrincipalesPerfilOrdenesMovimientos(int $iduser): ?Array //comentarios para el usuario solo DE AUTOS
    {
        $fechaInicio=new \DateTime('NOW');

        return $this->createQueryBuilder('c')
           /* ->select(array('c.fechaCreacion', 'c.id', 'c.mensaje', 'c.titulo', 'e.id as envio' ) )
            ->leftJoin('c.compra', 'co')
            ->leftJoin('co.detalleCompra',  'dc')
            ->leftJoin('dc.envio', 'e')*/
            ->leftJoin('c.etiquetados', 'etiq')
            ->andWhere("(c.autor = :usuario or etiq.id= :usuario ) 
                        and (c.tipo = 1 or c.tipo = 2 or c.tipo = 3 or c.tipo = 4 or c.tipo = 11) 
                        and (c.estado =2 or c.estado =4 or c.estado =5 or c.estado =6 ) 
                        and (c.respuestas is null)  and (c.fechaCreacion > :Inicio)
                        
            " )
            ->andWhere('c.compra is not null')          
            ->setParameter('usuario',  $iduser )
            ->setParameter('Inicio', new \DateTime('-6 MONTH'))
            
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    *   @return Comentarios[] Returns an array of DepartamentoEmpresa objects
    *  
    */
    public function ComentariosPrincipalesPerfilContenedores(int $iduser): ?Array //comentarios para el usuario solo de contenedores
    {
        $fechaInicio=new \DateTime('NOW');

        return $this->createQueryBuilder('c')
            ->leftJoin('c.etiquetados', 'etiq')
            ->andWhere("(c.autor = :usuario or etiq.id= :usuario ) 
                        and (c.tipo = 1 or c.tipo = 2 or c.tipo = 3 or c.tipo = 4 or c.tipo = 11) 
                        and (c.estado =2 or c.estado =4 or c.estado =5 or c.estado =6 ) 
                        and (c.respuestas is null)  and (c.fechaCreacion > :Inicio)
                        
            " )
            ->andWhere('c.contenedor is not null')         
            ->setParameter('usuario',  $iduser )
            ->setParameter('Inicio', new \DateTime('-6 MONTH'))
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }


    public function getComentariosTrack($compra, $contenedorTemp): ?Array
    {
        return $this->createQueryBuilder('c')
            ->select(array( 'c.id as comentario', 'env.id as envio','c.titulo', 'c.mensaje', 'est.nombre', 'dat.nombre' ,'dat.celular', 'c.fechaCreacion' ) )
            ->leftjoin('c.compra', 'o')
            ->leftjoin('o.detalleCompra', 'r')
            ->leftjoin('r.envio', 'env')
            ->leftjoin('c.autor', 'au')
            ->leftjoin('c.estado', 'est')
            ->leftjoin('au.empleado', 'emp')
            ->leftjoin('emp.datos', 'dat')
            ->andWhere('c.tipo = :tipo and (o.id = :compra or c.contenedor = :contenedorTemp)')
            ->setParameter('tipo', 3)
            ->setParameter('compra', $compra)
            ->setParameter('contenedorTemp', $contenedorTemp)
            ->orderBy('c.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getArrayResult()
        ;
    }
    
    public function ComentariosContenedorCreadosUsuarioArray($autor, $estado): ?Array
    {
        return $this->createQueryBuilder('c')
            ->select(array('c.fechaCreacion', 'c.id', 'c.mensaje', 'c.titulo', 'x.id as envio' ) )
            ->leftjoin('c.compra', 'o')
            ->leftjoin('o.detalleCompra', 'r')
            ->leftjoin('c.contenedor', 't')
            ->leftjoin('r.envio', 'x')
            ->andWhere('c.autor = :autor')
            ->andWhere('c.estado != :estado')
            ->andWhere('c.estado != :estadoMal')
            ->andWhere('c.tipo != :tipo')
            ->andWhere('c.respuestas IS NULL')
            ->andWhere('o.id IS NULL')
            ->setParameter('autor', $autor)
            ->setParameter('estado', $estado)
            ->setParameter('tipo', 5)
            ->setParameter('estadoMal', 8)
            ->orderBy('c.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getArrayResult()
        ;
    }

    public function ComentariosEtiquetadoUsuarioArray($etiqueta, $estado): ?Array
    {
        return $this->createQueryBuilder('c')
                ->select(array('c.fechaCreacion', 'c.id', 'c.mensaje', 'c.titulo', 'x.id as envio', 'r.lote', 'r.vin' ) )
                ->leftJoin('c.etiquetados', 't')
                ->leftjoin('c.compra', 'o')
                ->leftjoin('o.detalleCompra', 'r')
                ->leftjoin('r.envio', 'x')
                ->leftjoin('c.contenedor', 'y')
                ->andWhere('t.id = :etiqueta')
                ->andWhere('c.estado != :estado')
                ->andWhere('c.estado != :estadoMal')
                ->andWhere('y.id IS NULL')
                ->setParameter('etiqueta', $etiqueta)
                ->setParameter('estado', $estado)
                ->setParameter('estadoMal', 8)
                ->orderBy('c.id', 'ASC')
                //->setMaxResults(10)
            ->getQuery()
            ->getArrayResult()
        ;
    }
    public function ComentariosContenedorEtiquetadoUsuarioArray($etiqueta, $estado): ?Array
    {
        return $this->createQueryBuilder('c')
                ->select(array('c.fechaCreacion', 'c.id', 'c.mensaje', 'c.titulo', 'x.id as envio', 'r.lote', 'r.vin' ) )
                ->leftJoin('c.etiquetados', 't')
                ->leftjoin('c.compra', 'o')
                ->leftjoin('o.detalleCompra', 'r')
                ->leftjoin('r.envio', 'x')
                ->leftjoin('c.contenedor', 'y')
                ->andWhere('t.id = :etiqueta')
                ->andWhere('c.estado != :estado')
                ->andWhere('c.estado != :estadoMal')
                ->andWhere('o.id IS NULL')
                ->setParameter('etiqueta', $etiqueta)
                ->setParameter('estado', $estado)
                ->setParameter('estadoMal', 8)
                ->orderBy('c.id', 'ASC')
                //->setMaxResults(10)
            ->getQuery()
            ->getArrayResult()
        ;
    }

    public function findByIdGetIdEtiquetas($principal): ?Array
    {
        return $this->createQueryBuilder('c')
                ->select(array('c.id') )
                ->andWhere('c.respuestas = :principal')
                ->setParameter('principal', $principal)
                ->orderBy('c.id', 'ASC')
                //->setMaxResults(10)
            ->getQuery()
            ->getArrayResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Comentarios
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
