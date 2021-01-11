<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\RegistrarUsuarioType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrarUsuarioController extends AbstractController
{
    /**
     * @Route("/registrar-usuario", name="registrar_usuario")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $usuario = new Usuario();
        $form = $this->createForm(RegistrarUsuarioType::class, $usuario);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $usuario->setPassword($passwordEncoder->encodePassword($usuario, $form['password']->getData()));
            $em->persist($usuario);
            $em->flush();
            $this->addFlash('success', Usuario::REGISTRO_EXITOSO );
            return $this->redirectToRoute('registrar_usuario');
        }
        return $this->render('registrar_usuario/index.html.twig', [
            'formulario' => $form->createView()
        ]);
    }
}
