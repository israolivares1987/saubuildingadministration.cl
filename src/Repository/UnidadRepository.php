<?php

namespace App\Repository;

use App\Entity\Conjunto;
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

    public function buscarUnidadesPaginador(TipoUnidad $tipoUnidad = null, Conjunto $conjunto = null, $piso = null, $unidad = null, $estado = null) {
        $qb = $this->createQueryBuilder('u')
        ->select('u.id, t.nombre as tipoUnidad, c.nombre as edificio, u.piso, u.unidad, u.estado')
        ->leftJoin('u.conjunto', 'c')
        ->innerJoin('u.tipoUnidad', 't');

        if($tipoUnidad != null){
            $qb->andWhere('u.tipoUnidad = '.$tipoUnidad->getId());
        }
        if($conjunto != null){
            $qb->andWhere('u.conjunto = '.$conjunto->getId());
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

    public function buscarUnidadesClientes(Conjunto $conjunto = null, TipoUnidad $tipoUnidad = null, $unidad = null, $persona = null) {
        $qb = $this->createQueryBuilder('u')
        ->select('
            t.nombre as tipoUnidad,
            c.nombre as edificio, 
            u.piso, 
            u.unidad, 
            p.nombres as nombrePropietario, 
            p.representante as nombreRepresentante, 
            p.email1, 
            p.email2,
            co.factor,
            co.mensual,
            co.fondoReserva,
            co.adicional,
            coht.nombre as unidadHija_tipoUnidad, 
            cohc.nombre as unidadHija_edificio,
            coh.piso as unidadHija_piso,
            coh.unidad as unidadHija_unidad')
        ->leftJoin('u.tipoUnidad', 't') //join tipo unidad
        ->leftJoin('u.conjunto', 'c') //join conjunto
        ->leftJoin('u.propietario', 'pro') //join con propietario
        ->leftJoin('pro.cliente', 'p') //join con cliente segun id propietario
        ->leftJoin('u.cobro', 'co') //join con cobro de unidad
        ->leftJoin('co.unidadHija', 'coh') //join con unidad hija de cobro de unidad
        ->leftJoin('coh.tipoUnidad', 'coht') //join con tipo de unidad hija de cobro de unidad
        ->leftJoin('coh.conjunto', 'cohc'); //Join con conjunto de unidad hija de cobro de unidad
        if($tipoUnidad != null){
            $qb->andWhere('u.tipoUnidad = '.$tipoUnidad->getId());
        }
        if($conjunto != null){
            $qb->andWhere('u.conjunto = '.$conjunto->getId());
        }
        if($unidad != null){
            $qb->andWhere('u.unidad = '.$unidad);
        }
        if($persona != null){
            $qb->andWhere('p.nombres LIKE :nombres OR p.representante LIKE :nombres');
            $qb->setParameter('nombres', '%'.$persona.'%');
        }
        $qb->orderBy('u.id', 'asc');
        
        
        return $qb->getQuery()->getResult();
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
