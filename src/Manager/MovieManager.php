<?php
/**
 * Created by PhpStorm.
 * User: Moises
 * Date: 28/11/2018
 * Time: 7:38
 */

namespace App\Manager;


use App\Entity\Pelicula;
use Psr\Log\LoggerInterface;

class MovieManager
{
    protected $dir;
    protected $logger;
    protected $pelis;

    public function __construct($dir, LoggerInterface $logger)
    {
        $this->dir = $dir;
        $this->logger = $logger;

        $file = fopen($this->dir.'/movies.csv', 'r');
        $pelis = [];

        while ($peli = fgetcsv($file, 5000, '#')){
            $pelis[] = Pelicula::withValues($peli[0], $peli[1], $peli[2], $peli[3], $peli[4]);
        }

        $this->pelis = $pelis;
        fclose($file);
    }

    public function getMovies()
    {
        return $this->pelis;
    }

    public function addMovie(Pelicula $pelicula)
    {
        $this->pelis[] = $pelicula;
    }

    public function getMovie($slug): Pelicula
    {
        //dump($this->pelis);
        foreach ($this->pelis as $peli){
            if ($peli->getSlug() == $slug){
                return $peli;
            }
        }

        return null;
    }

    public function saveMovies()
    {
        $file = fopen($this->dir.'/movies.csv', 'w');

        foreach ($this->pelis as $peli){
            fputcsv($file, $peli->toArray(), '#');
        }
        fclose($file);
    }
}
