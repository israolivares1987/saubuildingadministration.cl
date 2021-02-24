<?php

namespace App\Controller;

use App\Entity\Cliente;
use App\Entity\Conjunto;
use App\Entity\TipoUnidad;
use App\Form\ClienteType;
use App\Repository\ClienteRepository;
use App\Repository\UnidadRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/clientes")
 */
class ClienteController extends AbstractController
{
    /**
     * @Route("/", name="mantenedores_clientes_index", methods={"GET"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function index(ClienteRepository $clienteRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $formFiltro = $this->createFormBuilder()
            ->add('nombres', TextType::class, [
                'required' => false
            ])
            ->add('representante', TextType::class, [
                'required' => false
            ])
            ->add('email1', TextType::class, [
                'required' => false,
                'label' => 'E-Mail'
            ])->add('filtrar', SubmitType::class, [
                'attr' => ['class' =>'btn btn-primary btn-block'],
                'label' => 'Filtrar'
            ])
            ->setMethod('GET')
            ->getForm();
        
        $formFiltro->handleRequest($request);
        $nombres = null;
        $representante = null;
        $email1 = null;
        if ($formFiltro->isSubmitted() && $formFiltro->isValid()) {
            $nombres = $formFiltro['nombres']->getData();
            $representante = $formFiltro['representante']->getData();
            $email1 = $formFiltro['email1']->getData();
        }
        $query = $clienteRepository->buscarClientesPaginador($nombres, $representante, $email1);
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            25 /*limit per page*/
        );
        $pagination->setCustomParameters([
            'align' => 'center', # center|right (for template: twitter_bootstrap_v4_pagination)
            'size' => 'large', # small|large (for template: twitter_bootstrap_v4_pagination)
            'style' => 'bottom'
        ]);
        return $this->render('cliente/index.html.twig', [
            'clientes' => $pagination,
            'formFiltro' => $formFiltro->createView()
        ]);
    }

    /**
     * @Route("/nuevo", name="cliente_nuevo", methods={"GET","POST"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function new(Request $request): Response
    {
        $cliente = new Cliente();
        $form = $this->createForm(ClienteType::class, $cliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cliente);
            $entityManager->flush();

            $this->addFlash('cliente_success', 'Se creó el cliente');

            return $this->redirectToRoute('mantenedores_clientes_index');
        }

        return $this->render('cliente/nuevo.html.twig', [
            'cliente' => $cliente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/unidades", name="clientes_unidades")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function unidades(UnidadRepository $unidadRepository, Request $request): Response
    {
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
                'required' => false,
                'label' => 'Nombre de la Persona'
            ])
            ->add('filtrar', SubmitType::class, [
                'attr' => ['class' =>'btn btn-primary btn-block'],
                'label' => 'Filtrar'
            ])
            ->getForm();
        $formFiltro->handleRequest($request);
        $conjunto = null;
        $tipoUnidad = null;
        $unidad = null;
        $persona = null;
        if ($formFiltro->isSubmitted() && $formFiltro->isValid()) {
            $conjunto = $formFiltro['conjunto']->getData();
            $tipoUnidad = $formFiltro['tipoUnidad']->getData();
            $unidad = $formFiltro['unidad']->getData();
            $persona = $formFiltro['persona']->getData();
        }
        $unidades = $unidadRepository->buscarUnidadesClientes($conjunto, $tipoUnidad, $unidad, $persona);
        return $this->render('cliente/clientes-unidades.html.twig', [
            'unidades' => $unidades,
            'formFiltro' => $formFiltro->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="cliente_ver", methods={"GET"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function show(Cliente $cliente): Response
    {
        return $this->render('cliente/ver.html.twig', [
            'cliente' => $cliente,
        ]);
    }

    /**
     * @Route("/{id}/editar", name="cliente_editar", methods={"GET","POST"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function edit(Request $request, Cliente $cliente): Response
    {
        $form = $this->createForm(ClienteType::class, $cliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('unidad_success', 'Se actualizó el cliente');

            return $this->redirectToRoute('mantenedores_clientes_index');
        }

        return $this->render('cliente/editar.html.twig', [
            'cliente' => $cliente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cliente_delete", methods={"DELETE"})
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function delete(Request $request, Cliente $cliente): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cliente->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cliente);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mantenedores_clientes_index');
    }


}
