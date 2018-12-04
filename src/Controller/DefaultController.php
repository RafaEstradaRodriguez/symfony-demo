<?php

namespace App\Controller;

use App\Entity\Pelicula;
use App\Form\PeliculaFormType;
use App\Manager\MovieManager;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/movie/{slug}", name="detalles_pelicula")
     */
    public function details($slug, MovieManager $manager)
    {
        foreach ($manager->getMovies() as $peli) {
            if ($peli->getSlug() == $slug) {
                $pelicula = $peli;
            }
        }

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
     * @Route("/movie-new", name="new_movie")
     */
    public function newPelicula(Request $request, MovieManager $manager)
    {
        $form = $this->createForm(PeliculaFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pelicula = $form->getData();
            $manager->addMovie($pelicula);
            $manager->saveMovies();
            $this->addFlash('success', 'Pelicula creada correctamente!');
            return $this->redirectToRoute('homepage');
        }


        return $this->render('new-movie.html.twig', ['movieForm' => $form->createView()]);
    }

    /**
     * @Route("/movie-edit/{slug}", name="edit_movie")
     */
    public function editPelicula(Request $request, $slug, MovieManager $manager)
    {
        $pelicula = $manager->getMovie($slug);

        $form = $this->createForm(PeliculaFormType::class, $pelicula);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->updateMovie($pelicula);
            $manager->saveMovies();
            $this->addFlash('success', 'Pelicula actualizada correctamente!');
            return $this->redirectToRoute('edit_movie', ['slug' => $pelicula->getSlug()]);
        }


        return $this->render('edit-movie.html.twig', ['movieForm' => $form->createView()]);

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
