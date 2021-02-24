<?php

namespace App\Repository;

use App\Entity\CuentaGastoComun;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CuentaGastoComun|null find($id, $lockMode = null, $lockVersion = null)
 * @method CuentaGastoComun|null findOneBy(array $criteria, array $orderBy = null)
 * @method CuentaGastoComun[]    findAll()
 * @method CuentaGastoComun[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CuentaGastoComunRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CuentaGastoComun::class);
    }

    // /**
    //  * @return CuentaGastoComun[] Returns an array of CuentaGastoComun objects
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
    public function findOneBySomeField($value): ?CuentaGastoComun
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
