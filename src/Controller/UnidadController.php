<?php

namespace App\Controller;

use App\Entity\Unidad;
use App\Form\UnidadType;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\UnidadRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/unidades")
 */
class UnidadController extends AbstractController
{
    /**
     * @Route("/", name="unidades_index", methods={"GET"})
     */
    public function index(UnidadRepository $unidadRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $unidadRepository->buscarUnidadesPaginador();
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
            $entityManager->persist($unidad);
            $entityManager->flush();

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
