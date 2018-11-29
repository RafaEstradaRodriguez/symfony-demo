<?php

namespace App\Controller;

use App\Entity\Pelicula;
use App\Manager\MovieManager;
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
    public function index(MovieManager $manager)
    {

        $movies = $manager->getMovies();
        return $this->render(
            'list.html.twig',
            [
                'peliculas' => $movies
            ]
        );
    }

    /**
     * @Route("/star/{slug}", name="star_pelicula")
     */
    public function starMovie($slug, MovieManager $manager) {

        $peli = $manager->getMovie($slug);

        if ($peli){
            $peli->incVisitas();
            $manager->saveMovies();
            $stars = $peli->getVisitas();
        } else {
            $stars = random_int(0,100);
        }
        return new JsonResponse(['stars' => $stars]);
    }

    /**
     * @Route("/unstar/{slug}", name="unstar_pelicula")
     */
    public function unstarMovie($slug, MovieManager $manager) {

        $peli = $manager->getMovie($slug);

        if ($peli){
            $peli->decVisitas();
            $manager->saveMovies();
            $stars = $peli->getVisitas();
        } else {
            $stars = random_int(0,100);
        }
        return new JsonResponse(['stars' => $stars]);
    }
}
