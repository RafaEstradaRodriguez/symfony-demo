<?php

namespace App\DataFixtures;

use App\Entity\Serie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class SerieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for($i=0; $i<10; $i++) {
            $serie = new Serie();
            $serie->setTitulo($faker->sentence(5));
            $serie->setDescripcion($faker->text);
            $serie->setFechaEstreno($faker->dateTimeBetween("-10 years", "-3 years"));

            $manager->persist($serie);

            $this->addReference(Serie::class . $i, $serie);
        }

        $manager->flush();
    }
}
