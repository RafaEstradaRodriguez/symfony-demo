<?php

namespace App\Tests\Service;

use App\Entity\Pelicula;
use App\Entity\User;
use App\Service\ParentalControl;
use PHPUnit\Framework\TestCase;

class ParentalControlTest extends Testcase
{
    private $parentalControl;

    protected function setUp()
    {
        $this->parentalControl = new ParentalControl();
    }

    /**
     * @test
     */
    public function filtraPeliculasSiElUsuarioEstaBajoControlParental()
    {

        $usuario = new User();
        $usuario->setEmail('kiko@gmail.com');
        $usuario->setUnderPC(true);

        $movie1 = new Pelicula();
        $movie1->setTitulo('Alien');
        $movie1->setClasificacion('+18');

        $movie2 = new Pelicula();
        $movie2->setTitulo('Moana');
        $movie2->setClasificacion('TP');

        $movies = [$movie1, $movie2];

        $this->assertCount(
            1,
            $this->parentalControl->filterMovies($usuario, $movies)
        );

        $this->assertEquals(
            [$movie2],
            $this->parentalControl->filterMovies($usuario, $movies)
        );
    }

    /**
     * @test
     */
    public function noFiltraPeliculasSiElUsuarioNoEstaBajoControlParental()
    {

        $usuario = new User();
        $usuario->setEmail('kiko@gmail.com');
        $usuario->setUnderPC(false);

        $movie1 = new Pelicula();
        $movie1->setTitulo('Alien');
        $movie1->setClasificacion('+18');

        $movie2 = new Pelicula();
        $movie2->setTitulo('Moana');
        $movie2->setClasificacion('TP');

        $movies = [$movie1, $movie2];

        $this->assertCount(
            2,
            $this->parentalControl->filterMovies($usuario, $movies)
        );

        $this->assertEquals(
            $movies,
            $this->parentalControl->filterMovies($usuario, $movies)
        );
    }
}
