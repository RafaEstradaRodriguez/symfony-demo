<?php

namespace App\Controller;

use App\Repository\PersonaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonaController extends AbstractController
{
    /**
     * @Route("/personas", name="list_personas")
     */
    public function index(PersonaRepository $personaRepository)
    {
        $personas = $personaRepository->findAll();

        return $this->render('persona/index.html.twig', [
            'personas' => $personas,
        ]);
    }

    /**
     * @Route("/personas-mayores-edad", name="list_personas_mayores_edad")
     */
    public function personasMayoresEdad(PersonaRepository $personaRepository)
    {
        $personas = $personaRepository->findMayoresEdad();

        return $this->render('persona/index.html.twig', [
            'personas' => $personas,
        ]);
    }

    /**
     * @Route("/5-mujeres-mas-mayores", name="list_mujeres_mas_mayores")
     */
    public function mujeresMasMayores(PersonaRepository $personaRepository)
    {
        $personas = $personaRepository->find5MujeresMasMayores();

        return $this->render('persona/index.html.twig', [
            'personas' => $personas,
        ]);
    }

    /**
     * @Route("/personas-registradas-ultima-semana", name="list_personas_registradas_ultima_semana")
     */
    public function personasRegistradasUltimaSemana(PersonaRepository $personaRepository)
    {
        $personas = $personaRepository->findPersonasRegistradasEnlaUltimaSemana();

        return $this->render('persona/index.html.twig', [
            'personas' => $personas,
        ]);
    }

    /**
     * @Route("/numero-personas-mayores-65", name="numero_personas_mayores_65")
     */
    public function sumaEdades5PersonasMasJovenes(PersonaRepository $personaRepository)
    {
        $result = $personaRepository->numeroDePersonasMayoresde65();
        return new Response(sprintf("La suma total es: %s", $result['total']));
    }
}
