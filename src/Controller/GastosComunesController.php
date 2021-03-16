<?php

namespace App\Controller;

use App\Entity\Conjunto;
use App\Entity\CuentaGastoComun;
use App\Entity\TipoUnidad;
use App\Entity\Unidad;
use App\Repository\UnidadRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @Route("/gastos-comunes")
 */
class GastosComunesController extends AbstractController
{
    /**
     * @Route("/administracion", name="gastos_comunes_administracion")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function index(UnidadRepository $unidadRepository, Request $request, SessionInterface $session): Response
    {
        $arrayAnios = ['2021' => 2021, '2022' => 2022];
        //<input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric">
        $formPago = $this->createFormBuilder()
            ->add('montoPago', NumberType::class, [
                'attr' => ['class' => 'numeric'],
                'grouping' => true,
                'scale' => 0,
                'label' => 'Monto Pago',
                'help' => 'Introduzca un valor numérico',
            ])
            ->add('mes', HiddenType::class)
            ->add('unidad', HiddenType::class)
            ->add('anio', HiddenType::class)
            ->add('guardar', SubmitType::class, [
                'attr' => ['class' => 'btn btn-success'],
                'label' => '<i class="fas fa-hand-holding-usd"></i> Guardar Pago',
                'label_html' => true
            ])
            ->setAction($this->generateUrl('gastos_comunes_generar_pago'))
            ->getform();

        $formFiltro = $this->createFormBuilder()
            ->add('conjunto', EntityType::class, [
                'class' => Conjunto::class,
                'choice_label' => 'nombre',
                'placeholder' => 'Seleccione...',
                'label' => 'Conjunto o Edificio',
                'required' => false
            ])
            ->add('tipoUnidad', EntityType::class, [
                'class' => TipoUnidad::class,
                'choice_label' => 'nombre',
                'placeholder' => 'Seleccione...',
                'label' => 'Tipo de Unidad',
                'required' => false
            ])
            ->add('unidad', TextType::class, [
                'required' => false
            ])
            ->add('persona', TextType::class, [
                'label' => 'Nombre de la Persona',
                'required' => false
            ])
            ->add('anio', ChoiceType::class, [
                'choices' => $arrayAnios,
                'placeholder' => false,
                'label' => false,
                'required' => false
            ])
            ->add('mes', HiddenType::class, [
                'data' => '1'
            ])
            ->add('filtrar', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary btn-block'],
                'label' => '<i class="fas fa-filter"></i> Filtrar',
                'label_html' => true
            ])
            ->getForm();
        $formFiltro->handleRequest($request);
        $conjunto = null;
        $tipoUnidad = null;
        $unidad = null;
        $persona = null;
        $anio = null;
        $mes = null;
        if ($formFiltro->isSubmitted() && $formFiltro->isValid()) {
            $conjunto = $formFiltro['conjunto']->getData();
            $tipoUnidad = $formFiltro['tipoUnidad']->getData();
            $unidad = $formFiltro['unidad']->getData();
            $persona = $formFiltro['persona']->getData();
            $anio = $formFiltro['anio']->getData();
            $mes = $formFiltro['mes']->getData();
        }
        $gastosComunes = $unidadRepository->buscarGastosComunes($conjunto, $tipoUnidad, $unidad, $persona, $anio, $mes);
        $comunidad = $session->get('comunidad');
        $paramFin = $comunidad->getParametrosFinacierosComunidad();
        return $this->render('gastos_comunes/administracion.html.twig', [
            'gastosComunes' => $gastosComunes,
            'paramFin' => $paramFin,
            'formFiltro' => $formFiltro->createView(),
            'formPago' => $formPago->createView()
        ]);
    }

    /**
     * @Route("/generarCobro", name="gastos_comunes_generar_cobro", options={"expose"=true})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function generarCobro(Request $request, SessionInterface $session)
    {
        if ($request->isXmlHttpRequest()) {
            try {
                $unidad = $request->request->get('unidad');
                $mes = $request->request->get('mes');
                $anio = $request->request->get('anio');
                $gastoUnidad = $this->guardarCobro($unidad, $mes, $anio, $session);
                return new JsonResponse(['success' => true, 'montoCobro' => $gastoUnidad->getMontoCobro(), 'unidad' => $gastoUnidad->getUnidad()->getTipoUnidad()->getNombre() . " " . $gastoUnidad->getUnidad()->getUnidad()]);
            } catch (Exception $e) {
                return new JsonResponse(['success' => false, 'msg' => $e->getMessage()]);
            }
        } else {
            throw new Exception('No permitido');
        }
    }

    /**
     * @Route("/generarPago", name="gastos_comunes_generar_pago", options={"expose"=true})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function generarPago(Request $request, SessionInterface $session)
    {
        if ($request->isXmlHttpRequest()) {
            try {
                $form = $request->request->get('form');
                //primero verificar si ya hay cobro creado de ser asi, solo actualizar pago y fecha pago
                $em = $this->getDoctrine()->getManager();
                $montoPago = $form['montoPago'];
                $unidad = $form['unidad'];
                $mes = $form['mes'];
                $anio = $form['anio'];

                //traemos si existe cuenta para mes y ano de la unidad
                $gastoUnidad = $em->getRepository(CuentaGastoComun::class)->findOneBy(array('unidad' => $unidad, 'anoGasto' => $anio, 'mesGasto' => $mes));
                if ($gastoUnidad) {
                    //si existe generamos el pago sin mas
                    $gastoUnidad->setMontoPago($montoPago);
                    $gastoUnidad->setFechaPago(new \DateTime());
                    $gastoUnidad->setSaldo($gastoUnidad->getMontoCobro() - $montoPago);
                    $em->flush();
                    return new JsonResponse(['success' => true, 'montoCobro' => $gastoUnidad->getMontoCobro(), 'montoPago' => $montoPago, 'saldo' => $gastoUnidad->getSaldo(), 'unidad' => $gastoUnidad->getUnidad()->getTipoUnidad()->getNombre() . " " . $gastoUnidad->getUnidad()->getUnidad()]);
                } else {
                    $crearGastoUnidad = $this->guardarCobro($unidad, $mes, $anio, $session);
                    //cuando se crea el gasto con el cobro generamos el pago sin mas
                    $crearGastoUnidad->setMontoPago($montoPago);
                    $crearGastoUnidad->setFechaPago(new \DateTime());
                    $crearGastoUnidad->setSaldo($crearGastoUnidad->getMontoCobro() - $montoPago);
                    $em->flush();
                    return new JsonResponse(['success' => true, 'montoCobro' => $crearGastoUnidad->getMontoCobro(), 'montoPago' => $montoPago, 'saldo' => $crearGastoUnidad->getSaldo(), 'unidad' => $crearGastoUnidad->getUnidad()->getTipoUnidad()->getNombre() . " " . $crearGastoUnidad->getUnidad()->getUnidad()]);
                }
            } catch (Exception $e) {
                return new JsonResponse(['success' => false, 'msg' => $e->getMessage()]);
            }
        } else {
            throw new Exception('No permitido');
        }
    }

    private function guardarCobro($unidad, $mes, $anio, SessionInterface $session)
    {
        $em = $this->getDoctrine()->getManager();

        //traemos la unidad
        $unidad = $em->getRepository(Unidad::class)->find($unidad);

        //parametros financieros
        $comunidad = $session->get('comunidad');
        $paramFin = $comunidad->getParametrosFinacierosComunidad();

        //variables gasto comun
        $varGastoComun = $unidad->getVariablesGastoComun();

        //calculos
        $factor = $varGastoComun->getFactor();
        $mensualBase = $factor * $paramFin->getCostoAnual() / 100;
        $fondoReserva = $mensualBase * $paramFin->getPorcFondoReserva() / 100;
        $adicional = $varGastoComun->getAdicional();
        $deuda = $varGastoComun->getDeudaHistorica();
        $montoGastoComun = $mensualBase + $fondoReserva + $adicional;
        if ($deuda > ($montoGastoComun * 2)) {
            $interes = $deuda * $paramFin->getPorcInteres() / 100;
        } else {
            $interes = 0;
        }
        $montoCobro = number_format($montoGastoComun + $deuda + $interes, 0, '', '');

        //crear objeto de cuenta gasto comun
        $gastoUnidad = new CuentaGastoComun;
        $gastoUnidad->setUnidad($unidad);
        $gastoUnidad->setFactor($factor);
        $gastoUnidad->setMensualBase($mensualBase);
        $gastoUnidad->setFondoReserva($fondoReserva);
        $gastoUnidad->setAdicional($adicional);
        $gastoUnidad->setDeuda($deuda);
        $gastoUnidad->setInteres($interes);
        $gastoUnidad->setAnoGasto($anio);
        $gastoUnidad->setMesGasto($mes);
        $gastoUnidad->setFactor($factor);
        $gastoUnidad->setMontoCobro($montoCobro);
        $gastoUnidad->setFechaCobro(new \DateTime());
        $em->persist($gastoUnidad);
        $em->flush();

        return $gastoUnidad; //'montoCobro' => $montoCobro, 'unidad' => $unidad->getTipoUnidad()->getNombre() . " " . $unidad->getUnidad());
    }
}
