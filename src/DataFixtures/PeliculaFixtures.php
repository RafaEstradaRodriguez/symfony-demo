<?php

namespace App\DataFixtures;

use App\Entity\Pelicula;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PeliculaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for($i = 0; $i< 10; $i++) {
            $pelicula = new Pelicula();
            $pelicula->setTitulo($faker->words(4, true));
            $pelicula->setDescripcion($faker->text);
            $pelicula->setVisitas($faker->numberBetween(0,1000));
            $pelicula->setImageUrl($faker->imageUrl());

            $manager->persist($pelicula);
        }


        $manager->flush();
    }
}
