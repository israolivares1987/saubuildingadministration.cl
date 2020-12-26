<?php

namespace App\Repository;

use App\Entity\TipoUnidad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoUnidad|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoUnidad|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoUnidad[]    findAll()
 * @method TipoUnidad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoUnidadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoUnidad::class);
    }

    // /**
    //  * @return TipoUnidad[] Returns an array of TipoUnidad objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TipoUnidad
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
