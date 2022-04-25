<?php

namespace App\Repository;

use App\Entity\UsuarioEmpleado;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * @method UsuarioEmpleado|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsuarioEmpleado|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsuarioEmpleado[]    findAll()
 * @method UsuarioEmpleado[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuarioEmpleadoRepository extends ServiceEntityRepository implements UserLoaderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsuarioEmpleado::class);
    }
    public function loadUserByUsername(string $usernameOrEmail)
    {
        $entityManager = $this->getEntityManager();

        return $entityManager->createQuery(
                'SELECT u
                FROM App\Entity\UsuarioEmpleado u
                WHERE u.usuario = :query'
            )
            ->setParameter('query', $usernameOrEmail)
            ->getOneOrNullResult();
    }

    public function findAllArray( ): ?Array
    {
        return $this->createQueryBuilder('c')
            ->select(array('c.id','c.usuario as nombre'))
            ->getQuery()
            ->getArrayResult()
        ;
    }
    public function findAllArrayName( ): ?Array
    {
        return $this->createQueryBuilder('c')
            ->select(array('c.id','c.usuario as nombre'))
            ->getQuery()
            ->getArrayResult()
        ;
    }


    // /**
    //  * @return UsuarioEmpleado[] Returns an array of UsuarioEmpleado objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UsuarioEmpleado
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
