<?php

namespace App\Repository;

use App\Entity\DatosUnidad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DatosUnidad|null find($id, $lockMode = null, $lockVersion = null)
 * @method DatosUnidad|null findOneBy(array $criteria, array $orderBy = null)
 * @method DatosUnidad[]    findAll()
 * @method DatosUnidad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DatosUnidadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DatosUnidad::class);
    }

    // /**
    //  * @return DatosUnidad[] Returns an array of DatosUnidad objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DatosUnidad
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
