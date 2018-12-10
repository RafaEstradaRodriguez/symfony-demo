<?php

namespace App\DataFixtures;

use App\Entity\Persona;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PersonaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for($i=0; $i<100; $i++ ) {
            $sex = $faker->randomElement(['male', 'female']);
            $persona = new Persona();
            $persona->setNombre($faker->name($sex));
            $persona->setCiudad($faker->city);
            $persona->setGenero($sex);
            $persona->setEdad($faker->numberBetween(1, 75));
            $persona->setFechaRegistro($faker->dateTimeBetween('-1 years', '-1 days'));

            $manager->persist($persona);
        }

        $manager->flush();
    }
}
