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

        for($i=0; $i<60; $i++) {
            $capitulo = new Capitulo();

            $capitulo->setTitulo($faker->sentence(5));
            $capitulo->setSinopsis($faker->text);
            $capitulo->setValoracion($faker->numberBetween(1,10));

            $capitulo->setSerie($this->getReference(Serie::class . $faker->numberBetween(0, 9)));

            $manager->persist($capitulo);
        }

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [SerieFixtures::class];
    }
}
