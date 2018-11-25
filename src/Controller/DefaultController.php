<?php

namespace App\Controller;

use App\Entity\Pelicula;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/pelicula/{slug}")
     */
    public function edit($slug)
    {
        foreach (Pelicula::getFakePeliculas() as $peli) {
            if ($peli->slug == $slug) {
                $pelicula = $peli;
            }
        }

        return $this->render('details.html.twig', ['pelicula' => $pelicula]);
    }

    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render(
            'list.html.twig',
            [
                'peliculas' => Pelicula::getFakePeliculas()
            ]
        );
    }
}
