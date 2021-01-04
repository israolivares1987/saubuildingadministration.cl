<?php

namespace App\Repository;

use App\Entity\Cliente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cliente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cliente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cliente[]    findAll()
 * @method Cliente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClienteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cliente::class);
    }

    public function buscarClientesPaginador($nombres = null, $representante = null, $email1 = null) {
        $qb = $this->createQueryBuilder('c')
        ->select('c.id, c.nombres, c.email1, c.representante');

        if($nombres != null){
            $qb->andWhere('c.nombres LIKE :nombres');
            $qb->setParameter('nombres', '%'.$nombres.'%');
        }
        if($representante != null){
            $qb->andWhere('c.representante LIKE :representante');
            $qb->setParameter('representante', '%'.$representante.'%');
        }
        if($email1 != null){
            $qb->andWhere('c.email1 LIKE :email1');
            $qb->setParameter('email1', '%'.$email1.'%');
        }
        
        return $qb->getQuery();
    }

    // /**
    //  * @return Cliente[] Returns an array of Cliente objects
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
    public function findOneBySomeField($value): ?Cliente
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
