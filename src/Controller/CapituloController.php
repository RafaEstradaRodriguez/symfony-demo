<?php

namespace App\Controller;

use App\Repository\CapituloRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CapituloController extends AbstractController
{
    /**
     * @Route("/capitulo", name="capitulo")
     */
    public function index(CapituloRepository $capituloRepository, Request $request, PaginatorInterface $paginator)
    {
        //if ?join=lo_que_sea
        if ($request->query->get('join')) {
            $query =  $capituloRepository->findAllWithJoin(true);

            $pagination = $paginator->paginate(
              $query,
              $request->query->get('page', 1),
              10
            );
        } else {
            $query =  $capituloRepository->findAllCapitulos(true);
            $pagination = $paginator->paginate(
                $query,
                $request->query->get('page', 1),
                10
            );
        }

        return $this->render('capitulo/index.html.twig', [
            'pagination' => $pagination
        ]);
    }
}
