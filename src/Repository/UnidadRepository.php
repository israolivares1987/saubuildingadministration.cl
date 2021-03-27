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

    public function buscarGastosComunes(Conjunto $conjunto = null, TipoUnidad $tipoUnidad = null, $unidad = null, $persona = null, $ano = null, $mes = null, $default) {

        $ano = $ano ?: 2021;
        $mes = $mes ?: 1;
        //p = propietario
        //t = tipo de unidad
        //u = unidad
        //cgc = cuenta gasto comun
        //vgc = variables gasto comun
        $qb = $this->createQueryBuilder('u')
        ->select('
            u.id as idUnidad,
            p.nombres as nombrePropietario, 
            p.representante as nombreRepresentante, 
            t.nombre as tipoUnidad,
            u.unidad, 
            cgc.factor as factor_cgc,
            cgc.mensualBase as mensualBase_cgc,
            cgc.fondoReserva as fondoReserva_cgc,
            cgc.adicional as adicional_cgc,
            cgc.deuda as deuda_cgc,
            cgc.interes as interes_cgc,
            cgc.anoGasto as anio_gasto,
            cgc.mesGasto as mes_gasto,
            cgc.montoCobro as montoCobro_cgc,
            cgc.montoPago as montoPago_cgc,
            cgc.saldo as saldo_cgc,
            vgc.factor as factor_vgc,
            vgc.adicional as adicional_vgc,
            vgc.deudaHistorica as deuda_vgc')
        ->leftJoin('u.propietario', 'pro') //join con propietario
        ->leftJoin('pro.cliente', 'p') //join con cliente segun id propietario
        ->leftJoin('u.tipoUnidad', 't') //join tipo unidad
        ->leftJoin('u.conjunto', 'c'); //join conjunto
        if($default){
            $qb->leftJoin('u.cuentasGastoComun', 'cgc') //join con cuenta de gasto comun de unidad
            ->andWhere('cgc.anoGasto = '.$ano.' OR cgc.anoGasto IS NULL')
            ->andWhere('cgc.mesGasto = '.$mes.' OR cgc.mesGasto IS NULL');
        }
        else {
            $mesAnterior = $mes-1;
            $qb->innerJoin('u.cuentasGastoComun', 'cgc') //join con cuenta de gasto comun de unidad
            ->andWhere('cgc.anoGasto = '.$ano)
            //para buscar para este mes debe haber (pago de mes anterior) XOR (cobro o pago de este mes)
            ->andWhere('(cgc.mesGasto = '.$mesAnterior.' AND cgc.saldo IS NOT NULL) OR (cgc.mesGasto = '.$mes.' AND (cgc.montoCobro IS NOT NULL OR cgc.saldo IS NOT NULL))');
        }
        $qb->leftJoin('u.variablesGastoComun', 'vgc') //join con variables de gasto comun de unidad
        ->andWhere('vgc.factor IS NOT NULL');
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
        $qb->addOrderBy('cgc.mesGasto', 'desc');        
        
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
