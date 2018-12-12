<?php

namespace App\Controller;

use App\Repository\CapituloRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CapituloController extends AbstractController
{
    /**
     * @Route("/capitulo", name="capitulo")
     */
    public function index(CapituloRepository $capituloRepository, Request $request)
    {
        //if ?join=lo_que_sea
        if ($request->query->get('join')) {
            $capitulos = $capituloRepository->findAllWithJoin();
        } else {
            $capitulos = $capituloRepository->findAll();
        }

        return $this->render('capitulo/index.html.twig', [
            'capitulos' => $capitulos
        ]);
    }
}
