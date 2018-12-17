<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    /**
     * @Route("/serie", name="serie")
     */
    public function index(SerieRepository $serieRepository)
    {
        $series = $serieRepository->findAll();

        return $this->render('serie/index.html.twig', [
            'series' => $series
        ]);
    }

    /**
     * @Route("/serie/{id}", name="serie_details")
     */
    public function showSerie(Serie $serie)
    {
        return $this->render('serie/details.html.twig', [
            'serie' => $serie
        ]);
    }
}
