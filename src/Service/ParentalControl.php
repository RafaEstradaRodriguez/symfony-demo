<?php

namespace App\Service;

use App\Entity\User;

class ParentalControl
{

    /**
     * Filtra aquellas películas marcadas para público adulto, a
     * aquellos usuarios bajo el control parental.
     */
    public function filterMovies(User $usuario, array $movies)
    {
        if (!$usuario->isUnderPC()) {
            return $movies;
        }

        $filteredMovies = [];
        foreach ($movies as $movie) {
            if ($movie->getClasificacion() != '+18') {
                $filteredMovies[] = $movie;
            }
        }

        return $filteredMovies;
    }
}
