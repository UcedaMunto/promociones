<?php

namespace App\Repository;

use App\Entity\Grueros;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Expr\FuncCall;

/**
 * @method Grueros|null find($id, $lockMode = null, $lockVersion = null)
 * @method Grueros|null findOneBy(array $criteria, array $orderBy = null)
 * @method Grueros[]    findAll()
 * @method Grueros[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GruerosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Grueros::class);
    }

    public function gruerosValidos(){
        return $this->createQueryBuilder('a')
                ->andWhere('a.fechaUltimoUso > :M48h')
                ->setParameter('M48h', new \DateTime(date("Y/m/d",strtotime( date("Y/m/d")."- 100 day"))))
                ->orderBy('a.nombre', 'ASC');
    }
    /*
    public function gruerosValidosControlador(){
        return $this->gruerosValidos()->getQuery()
        ->getResult();
    }*/


    // /**
    //  * @return Grueros[] Returns an array of Grueros objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Grueros
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
