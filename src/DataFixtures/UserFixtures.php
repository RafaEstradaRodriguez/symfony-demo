<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i<3; $i++) {
            $usuario = new User();

            $usuario->setEmail("usuario$i@upgradehub.com");
            $usuario->setPassword(123);

            $manager->persist($usuario);
        }

        $manager->flush();
    }
}
