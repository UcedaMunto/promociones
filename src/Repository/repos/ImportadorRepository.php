<?php

namespace App\Repository;

use App\Entity\Importador;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Importador|null find($id, $lockMode = null, $lockVersion = null)
 * @method Importador|null findOneBy(array $criteria, array $orderBy = null)
 * @method Importador[]    findAll()
 * @method Importador[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImportadorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Importador::class);
    }

            public function importadoresValidosCombo()
            {
                return $this->createQueryBuilder('i')
                   /* ->andWhere('i.estado = 1 or i.estado IS NULL') validado en controlador*/   
                    ->andWhere('i.subasta = 1 or i.subasta = 2')
                    ->orderBy('i.buyer', 'ASC')
                ;
            }
            /**
             * @return Importador[] Returns an array of Importador objects
            */
            public function importadoresValidos(){
                return $this->findImportadoresValidosCombo()->getQuery()->getResult();
            }
    

    // /**
    //  * @return Importador[] Returns an array of Importador objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Importador
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
