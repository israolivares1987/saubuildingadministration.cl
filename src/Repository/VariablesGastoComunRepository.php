<?php

namespace App\Repository;

use App\Entity\VariablesGastoComun;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VariablesGastoComun|null find($id, $lockMode = null, $lockVersion = null)
 * @method VariablesGastoComun|null findOneBy(array $criteria, array $orderBy = null)
 * @method VariablesGastoComun[]    findAll()
 * @method VariablesGastoComun[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VariablesGastoComunRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VariablesGastoComun::class);
    }

    // /**
    //  * @return VariablesGastoComun[] Returns an array of VariablesGastoComun objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VariablesGastoComun
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
