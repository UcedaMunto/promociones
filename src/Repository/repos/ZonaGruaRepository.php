<?php

namespace App\Repository;

use App\Entity\ZonaGrua;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ZonaGrua|null find($id, $lockMode = null, $lockVersion = null)
 * @method ZonaGrua|null findOneBy(array $criteria, array $orderBy = null)
 * @method ZonaGrua[]    findAll()
 * @method ZonaGrua[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZonaGruaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ZonaGrua::class);
    }

    // /**
    //  * @return ZonaGrua[] Returns an array of ZonaGrua objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ZonaGrua
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
