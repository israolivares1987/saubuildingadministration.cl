<?php

namespace App\Controller;

use App\Entity\Cliente;
use App\Form\ClienteType;
use App\Repository\ClienteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/", name="clientes_index", methods={"GET"})
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
            10 /*limit per page*/
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

            return $this->redirectToRoute('cliente_index');
        }

        return $this->render('cliente/new.html.twig', [
            'cliente' => $cliente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cliente_ver", methods={"GET"})
     */
    public function show(Cliente $cliente): Response
    {
        return $this->render('cliente/show.html.twig', [
            'cliente' => $cliente,
        ]);
    }

    /**
     * @Route("/{id}/editar", name="cliente_editar", methods={"GET","POST"})
     */
    public function edit(Request $request, Cliente $cliente): Response
    {
        $form = $this->createForm(ClienteType::class, $cliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cliente_index');
        }

        return $this->render('cliente/edit.html.twig', [
            'cliente' => $cliente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cliente_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cliente $cliente): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cliente->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cliente);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cliente_index');
    }
}
