<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/edit/{id}", name="editar_usuario")
     */
    public function edit($id)
    {
        return $this->render('other.html.twig', ['nombre' => 'John']);
    }

    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return new JsonResponse();
        return $this->json(['result' => 'ok']);
    }
}
