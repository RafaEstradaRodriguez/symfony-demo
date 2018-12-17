<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Tests\Encoder\PasswordEncoder;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for($i=1; $i<6; $i++) {
            $usuario = new User();
            $usuario->setEmail("usuario$i@upgrade-hub.com");
            $usuario->setPassword($this->passwordEncoder->encodePassword(
                $usuario,
                '123'
            ));

            $manager->persist($usuario);
        }

        $manager->flush();
    }
}
