<?php

namespace App\Repository;

use App\Entity\Conjunto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Conjunto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Conjunto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Conjunto[]    findAll()
 * @method Conjunto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConjuntoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conjunto::class);
    }

    // /**
    //  * @return Conjunto[] Returns an array of Conjunto objects
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
    public function findOneBySomeField($value): ?Conjunto
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
