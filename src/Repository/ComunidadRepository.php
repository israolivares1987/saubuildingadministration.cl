<?php

namespace App\Repository;

use App\Entity\Comunidad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comunidad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comunidad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comunidad[]    findAll()
 * @method Comunidad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComunidadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comunidad::class);
    }

    // /**
    //  * @return Comunidad[] Returns an array of Comunidad objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Comunidad
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
