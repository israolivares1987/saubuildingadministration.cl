<?php

namespace App\Repository;

use App\Entity\RolPermiso;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RolPermiso|null find($id, $lockMode = null, $lockVersion = null)
 * @method RolPermiso|null findOneBy(array $criteria, array $orderBy = null)
 * @method RolPermiso[]    findAll()
 * @method RolPermiso[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RolPermisoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RolPermiso::class);
    }

    // /**
    //  * @return RolPermiso[] Returns an array of RolPermiso objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RolPermiso
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
