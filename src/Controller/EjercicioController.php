<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EjercicioController extends AbstractController
{
    /**
     * @Route("/ejercicios/emojis")
     */
    public function ejercicioEmojis()
    {
        $texto = "Montar en avión es una caca, excepto cuando hace sol.";

        return $this->render('emojis.html.twig', ['texto' => $texto]);
    }

    /**
     * @Route("/ejercicios/ordenacion")
     */
    public function ejercicioOrdenacion()
    {
        $usuarios = [
          [
              "nombre" => "Moi",
              "puntuacion" => 7.8,
              "universidad" => "Extremadura"
          ],
          [
              "nombre" => "Kiko",
              "puntuacion" => 9,
              "universidad" => "Oviedo"
          ],
          [
              "nombre" => "Jorge",
              "puntuacion" => 2.53,
              "universidad" => "De la vida"
          ],
          [
                "puntuacion" => 3.342,
                "universidad" => "Hogwarts"
          ],
          [
              "nombre" => "Ana",
              "puntuacion" => 7.256,
              "universidad" => "Oviedo"
          ],
        ];

        //lo ordenamos aqui desde el código php
        usort($usuarios, function ($u1, $u2) {
           return $u2['puntuacion'] <=> $u1['puntuacion'];
        });

        return $this->render(
            'usuarios.html.twig',
            ['usuarios' => $usuarios]
        );
    }
}
