<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    const TAGS = ['aventuras', 'amor', 'horror', 'clásico', 'documental'];

    public function load(ObjectManager $manager)
    {
        for($i=0; $i<5; $i++) {
            $tag = new Tag();
            $tag->setNombre(self::TAGS[$i]);
            $this->addReference(Tag::class . $i, $tag);

            $manager->persist($tag);
        }

        $manager->flush();
    }
}
