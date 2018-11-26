<?php

namespace App\Controller;

use App\Entity\Pelicula;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/movie/{slug}", name="detalles_pelicula")
     */
    public function edit($slug)
    {
        foreach (Pelicula::getFakePeliculas() as $peli) {
            if ($peli->slug == $slug) {
                $pelicula = $peli;
            }
        }

        //$logger->debug('PELICULA ENCONTRADA');

        return $this->render('details.html.twig', ['pelicula' => $pelicula]);
    }

    /**
     * @Route("/", name="homepage")
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

    /**
     * @Route("/star/{slug}", name="star_pelicula")
     */
    public function starMovie($slug) {
        return new JsonResponse(['stars' => random_int(0,100)]);
    }
}
