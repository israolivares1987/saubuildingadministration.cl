<?php

namespace App\Repository;

use App\Entity\ParametrosFinacierosComunidad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ParametrosFinacierosComunidad|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParametrosFinacierosComunidad|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParametrosFinacierosComunidad[]    findAll()
 * @method ParametrosFinacierosComunidad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParametrosFinacierosComunidadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParametrosFinacierosComunidad::class);
    }

    // /**
    //  * @return ParametrosFinacierosComunidad[] Returns an array of ParametrosFinacierosComunidad objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ParametrosFinacierosComunidad
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
