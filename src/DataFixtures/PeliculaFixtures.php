<?php

namespace App\DataFixtures;

use App\Entity\Pelicula;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PeliculaFixtures extends Fixture implements DependentFixtureInterface
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
            $pelicula->setClasificacion($faker->randomElement(['TP', '+12', '+16', '+18']));

            //obtengo el número total de tags que tendrá la pelicula
            $numTags = $faker->numberBetween(1,5);

            foreach ($faker->randomElements(range(0,4), $numTags) as $num) {
                $pelicula->addTag($this->getReference(Tag::class . $num));
            }

            $manager->persist($pelicula);
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        return [TagFixtures::class];
    }
}
