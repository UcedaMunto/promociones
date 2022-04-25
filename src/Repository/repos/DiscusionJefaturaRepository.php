<?php

namespace App\Repository;

use App\Entity\DiscusionJefatura;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DiscusionJefatura|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiscusionJefatura|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiscusionJefatura[]    findAll()
 * @method DiscusionJefatura[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiscusionJefaturaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiscusionJefatura::class);      
    }


    public function getJefes() 
    {
        $bosses = $this->getEntityManager()->getConnection();
        $statement = $bosses->prepare(
            "
            select de.nombre as departamento, de.id, dp.nombre , dp.apellido from departamento_empresa de 
            left join usuario_empleado ue on de.supervisor_id  = ue.id 
            left join persona_empleado pe on ue.empleado_id = pe.id 
            left join datos_persona dp on pe.datos_id  = dp.id             
                "
            );
            $statement->execute();
        $result = $statement->fetchAll();
        return $result;
        }

    // /**
    //  * @return DiscusionJefatura[] Returns an array of DiscusionJefatura objects
    //  */
    
    public function findLast20()
    {
        return $this->createQueryBuilder('d')  
            ->select('d.id, d.fecha, d.descripcion, d.titulo')                 
            ->orderBy('d.id', 'DESC')
            ->setMaxResults(20)
            ->addOrderBy('d.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findLast10()
    {
        return $this->createQueryBuilder('d')  
            ->select('d.id, d.fecha, d.descripcion, d.titulo')                 
            ->orderBy('d.id', 'DESC')
            ->setMaxResults(10)
            ->addOrderBy('d.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

 
    
    public function findLast()
    {
        return $this->createQueryBuilder('d')  
            ->select('d.id, d.fecha, d.descripcion, d.titulo')                 
            ->orderBy('d.id', 'DESC')
            ->setMaxResults(5)
            ->addOrderBy('d.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }



    public function verreunion($id)
    {
        return $this->createQueryBuilder('d')  
            ->select('d.id, d.fecha, d.descripcion')     
            ->andWhere('d.id = :ide')
            ->setParameter('ide', $id)  
            ->getQuery()
            ->getResult()
        ;
    }
    


    public function djDepartamentosAgregados($discusion): ?Array
    {
        return $this->createQueryBuilder('c')
            ->select(array('c.id','c.tituloComent', 'c.fecha', 'c.mensaje',  'ue.usuario', 'rp.id as resp', 'dj.id as disre' ) )
            ->leftjoin('c.usuarioEmpleado', 'ue')
            ->leftjoin('c.respuesta', 'rp')
            ->leftjoin('c.discusionJefatura', 'dj')
            ->andWhere('c.discusionJefatura = :discusion')
            ->setParameter('discusion', $discusion)
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getArrayResult()
        ;
    }


    

    
    /*
    
    SELECT  * FROM discusion_jefatura  order by id desc limit 5
    
    */
    /*
    public function findOneBySomeField($value): ?DiscusionJefatura
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
