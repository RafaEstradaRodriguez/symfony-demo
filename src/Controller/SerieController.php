<?php

namespace App\Controller;

use App\Entity\Serie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    /**
     * @Route("/series/{id}", name="serie_details")
     */
    public function showSerie(Serie $serie)
    {
        foreach ($serie->getCapitulos() as $capitulo){

        }
        return $this->render('serie/index.html.twig', [
            'controller_name' => 'SerieController',
        ]);
    }
}
