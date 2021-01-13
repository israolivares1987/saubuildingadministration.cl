<?php

namespace App\Repository;

use App\Entity\TipoUnidad;
use App\Entity\Unidad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Unidad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Unidad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Unidad[]    findAll()
 * @method Unidad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnidadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Unidad::class);
    }

    public function buscarUnidadesPaginador(TipoUnidad $tipoUnidad = null, $edificio = null, $piso = null, $unidad = null, $estado = null) {
        $qb = $this->createQueryBuilder('u')
        ->select('u.id, t.nombre as tipoUnidad, c.nombre as edificio, u.piso, u.unidad, u.estado')
        ->innerJoin('u.conjunto', 'c')
        ->innerJoin('u.tipoUnidad', 't');

        if($tipoUnidad != null){
            $qb->andWhere('u.tipoUnidad = '.$tipoUnidad->getId());
        }
        if($edificio != null){
            $qb->andWhere('c.nombre LIKE :edificio');
            $qb->setParameter('edificio', '%'.$edificio.'%');
        }
        if($piso != null){
            $qb->andWhere('u.piso = '.$piso);
        }
        if($unidad != null){
            $qb->andWhere('u.unidad = '.$unidad);
        }
        if(!is_null($estado)){
            $estado = ($estado) ? '1' : '0';
            $qb->andWhere('u.estado = '.$estado);
        }
        
        return $qb->getQuery();
    }

    public function buscarUnidadesClientes() {
        return $this->createQueryBuilder('u')
        ->select('t.nombre as tipoUnidad, c.nombre as edificio, u.piso, u.unidad, p.nombres as nombrePropietario, p.representante, a.nombres as nombreArrendatario')
        ->leftJoin('u.conjunto', 'c')
        ->leftJoin('u.tipoUnidad', 't')
        ->leftJoin('u.propietario', 'pro')
        ->leftJoin('pro.cliente', 'p')
        ->leftJoin('u.arrendatario', 'arr')
        ->leftJoin('arr.cliente', 'a')
        ->getQuery()
        ->getResult();
    }

    // /**
    //  * @return Unidad[] Returns an array of Unidad objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Unidad
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
