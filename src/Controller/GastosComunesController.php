<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gastos-comunes")
 */
class GastosComunesController extends AbstractController
{
    /**
     * @Route("/administracion", name="gastos_comunes_administracion")
     */
    public function index(): Response
    {
        return $this->render('gastos_comunes/administracion.html.twig', [
            'controller_name' => 'GastosComunesController',
        ]);
    }
}
