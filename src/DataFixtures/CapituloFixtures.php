<?php

namespace App\DataFixtures;

use App\Entity\Capitulo;
use App\Entity\Serie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class CapituloFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for($i=0; $i<100; $i++) {
            $capitulo = new Capitulo();
            $capitulo->setTitulo($faker->sentence);
            $capitulo->setValoracion($faker->numberBetween(0,10));
            $capitulo->setSerie($this->getReference(Serie::class . $faker->numberBetween(0,4)));

            $manager->persist($capitulo);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [SerieFixtures::class];
    }
}
