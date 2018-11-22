<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /**
     * @Route("/hola/{nombre}")
     */
    public function index($nombre)
    {
        return new Response("Cómo molas $nombre");
    }
}
