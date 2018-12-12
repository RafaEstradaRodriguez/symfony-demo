<?php

namespace App\Controller;

use App\Entity\Pelicula;
use App\Form\PeliculaFormType;
use App\Manager\MovieManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(EntityManagerInterface $em, Request $request)
    {
        //if ?join=lo_que_sea
        if ($request->query->get('join')) {
            //también podemos inyectar el repositorio directamente
            $movies = $em->getRepository(Pelicula::class)->findAllWithJoin();
        } else {
            $movies = $em->getRepository(Pelicula::class)->findAll();
        }


        return $this->render(
            'list.html.twig',
            [
                'peliculas' => $movies
            ]
        );
    }

    /**
     * @Route("/movie/new", name="new_movie")
     */
    public function newPelicula(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(PeliculaFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pelicula = $form->getData();
            $em->persist($pelicula);
            $em->flush();

            $this->addFlash('success', 'Pelicula creada correctamente!');
            return $this->redirectToRoute('homepage');
        }


        return $this->render('new-movie.html.twig', ['movieForm' => $form->createView()]);
    }

    /**
     * @Route("/movie/edit/{slug}", name="edit_movie")
     */
    public function editPelicula(Request $request, Pelicula $pelicula, EntityManagerInterface $em)
    {
        $form = $this->createForm(PeliculaFormType::class, $pelicula);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Pelicula actualizada correctamente!');
            return $this->redirectToRoute('edit_movie', ['slug' => $pelicula->getSlug()]);
        }


        return $this->render('edit-movie.html.twig', ['movieForm' => $form->createView()]);

    }

    /**
     * @Route("/movie/{slug}", name="detalles_pelicula")
     */
    public function details(Pelicula $pelicula)
    {
        return $this->render('details.html.twig', ['pelicula' => $pelicula]);
    }

    /**
     * @Route("/star/{slug}", name="star_pelicula")
     */
    public function starMovie(Pelicula $pelicula, EntityManagerInterface $em)
    {
        $pelicula->incVisitas();
        $stars = $pelicula->getVisitas();

        $em->flush();

        return new JsonResponse(['stars' => $stars]);
    }

    /**
     * @Route("/unstar/{slug}", name="unstar_pelicula")
     */
    public function unstarMovie(Pelicula $pelicula, EntityManagerInterface $em)
    {
        $pelicula->decVisitas();
        $stars = $pelicula->getVisitas();

        $em->flush();

        return new JsonResponse(['stars' => $stars]);
    }
}
