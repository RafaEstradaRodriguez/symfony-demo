<?php

namespace App\Controller;

use App\Entity\Capitulo;
use App\Repository\CapituloRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CapituloController extends AbstractController
{
    /**
     * @Route("/capitulos", name="list")
     */
    public function index(CapituloRepository $capituloRepository)
    {
        $capitulos = $capituloRepository->findAll();

        return $this->render('capitulo/list.html.twig', ['capitulos' => $capitulos]);
    }

    /**
     * @Route("/capitulosconinner", name="listconinner")
     */
    public function indexConInner(CapituloRepository $capituloRepository)
    {
        $capitulos = $capituloRepository->findAddWithJoin();

        return $this->render('capitulo/list.html.twig', ['capitulos' => $capitulos]);
    }

    /**
     * @Route("/capitulos/{id}", name="capitulo_details")
     */
    public function showCapitulo(Capitulo $capitulo)
    {
        return $this->render('capitulo/index.html.twig', [
            'controller_name' => 'CapituloController',
        ]);
    }
}
