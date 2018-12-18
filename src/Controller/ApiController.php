<?php

namespace App\Controller;


use App\Repository\PeliculaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{

    /**
     * @Route("/api/peliculas", name="api_peliculas")
     */
    public function getPeliculas(PeliculaRepository $peliculaRepository)
    {
        $peliculas = $peliculaRepository->findAll();

        return $this->json($peliculas, 200, [], ['groups' => ['main']]);
    }

}
