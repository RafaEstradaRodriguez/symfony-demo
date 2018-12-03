<?php

namespace App\Controller;


use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractController
{

    /**
     * @Route("/users/new", name="new_user")
     */
    public function newUsuario(EntityManagerInterface $em)
    {
        $usuario = new Usuario();
        $usuario->setNombre('Rocio');

        $em->persist($usuario);
        $em->flush();

        return new Response("Creado !!");
    }

    /**
     * @Route("/users/list", name="list_users")
     */
    public function listUsuarios(EntityManagerInterface $em)
    {
        $repositorio = $em->getRepository(Usuario::class);
        $usuario = $repositorio->find(1);

        return $this->render('usuario/list.html.twig');
    }
}
