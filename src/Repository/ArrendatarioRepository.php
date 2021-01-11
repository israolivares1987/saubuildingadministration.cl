<?php

namespace App\Repository;

use App\Entity\Arrendatario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Arrendatario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Arrendatario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Arrendatario[]    findAll()
 * @method Arrendatario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArrendatarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Arrendatario::class);
    }

    // /**
    //  * @return Arrendatario[] Returns an array of Arrendatario objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Arrendatario
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
