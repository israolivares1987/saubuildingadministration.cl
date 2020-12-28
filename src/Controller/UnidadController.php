<?php

namespace App\Controller;

use App\Entity\Empresa;
use App\Entity\TipoUnidad;
use App\Entity\Unidad;
use App\Form\UnidadType;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\UnidadRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/unidades")
 */
class UnidadController extends AbstractController
{
    /**
     * @Route("/", name="unidades_index", methods={"GET", "POST"})
     */
    public function index(UnidadRepository $unidadRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $formFiltro = $this->createFormBuilder()
            ->add('tipoUnidad', EntityType::class, [
                'class' => TipoUnidad::class,
                'choice_label' => 'nombre',
                'placeholder' => 'Seleccione...',
                'label' => 'Tipo Unidad',
                'required' => false
            ])
            ->add('edificio', TextType::class, [
                'required' => false
            ])
            ->add('piso', IntegerType::class, [
                'required' => false
            ])
            ->add('unidad', TextType::class, [
                'required' => false
            ])
            ->add('estado', ChoiceType::class, [
                'choices' => [
                    'Activo' => true,
                    'Inactivo' => false,
                ],
                'placeholder' => 'Seleccione...',
                'required' => false
            ])->add('filtrar', SubmitType::class, [
                'attr' => ['class' =>'btn btn-primary btn-block'],
                'label' => 'Filtrar'
            ])
            ->setMethod('GET')
            ->getForm();
        
        $formFiltro->handleRequest($request);
        $tipoUnidad = null;
        $edificio = null;
        $piso = null;
        $unidad = null;
        $estado = null;
        if ($formFiltro->isSubmitted() && $formFiltro->isValid()) {
            $tipoUnidad = $formFiltro['tipoUnidad']->getData();
            $edificio = $formFiltro['edificio']->getData();
            $piso = $formFiltro['piso']->getData();
            $unidad = $formFiltro['unidad']->getData();
            $estado = $formFiltro['estado']->getData();
        }
        $query = $unidadRepository->buscarUnidadesPaginador($tipoUnidad, $edificio, $piso, $unidad, $estado);
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
        return $this->render('unidad/index.html.twig', [
            'unidades' => $pagination,
            'formFiltro' => $formFiltro->createView()
        ]);
    }

    /**
     * @Route("/nuevo", name="unidades_nuevo", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $unidad = new Unidad();
        $form = $this->createForm(UnidadType::class, $unidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $empresa = $entityManager->getRepository(Empresa::class)->find(1);
            $unidad->setEmpresa($empresa);
            $entityManager->persist($unidad);
            $entityManager->flush();

            $this->addFlash('unidad_success', 'Se creó la unidad');

            return $this->redirectToRoute('unidades_index');
        }

        return $this->render('unidad/nuevo.html.twig', [
            'unidad' => $unidad,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="unidades_ver", methods={"GET"})
     */
    public function show(Unidad $unidad): Response
    {
        return $this->render('unidad/ver.html.twig', [
            'unidad' => $unidad,
        ]);
    }

    /**
     * @Route("/{id}/editar", name="unidades_editar", methods={"GET","POST"})
     */
    public function edit(Request $request, Unidad $unidad): Response
    {
        $form = $this->createForm(UnidadType::class, $unidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('unidad_success', 'Se actualizó la unidad');

            return $this->redirectToRoute('unidades_index');
        }

        return $this->render('unidad/editar.html.twig', [
            'unidad' => $unidad,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="unidades_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Unidad $unidad): Response
    {
        if ($this->isCsrfTokenValid('delete'.$unidad->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($unidad);
            $entityManager->flush();
        }

        return $this->redirectToRoute('unidades_index');
    }
}
