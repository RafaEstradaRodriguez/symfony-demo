<?php

namespace App\DataFixtures;

use App\Entity\Capitulo;
use App\Entity\Serie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class SerieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for($i=0; $i<5; $i++) {
            $serie = new Serie();
            $serie->setTitulo($faker->sentence);
            $serie->setDescripcion($faker->text);
            $serie->setFechaDeEstreno($faker->dateTimeBetween('-10 years', '-1 days'));

            $this->addReference(Serie::class . $i, $serie);

            $manager->persist($serie);
        }

        $manager->flush();
    }
}
