<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Gun;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GunsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $guns = [
            '2 cm KwK 30',
            '3.7 cm KwK 36 L/45',
            '5 cm KwK 38',
            '5 cm KwK 39',
            '7.5 cm KwK 37',
            '7.5 cm KwK 40',
            '7.5 cm KwK 42',
            'KwK 36',
            'KwK 43 L71',
            '12.8 cm Pak 44',
        ];

        foreach ($guns as $gunName) {
            $gunEntity = new Gun();
            $gunEntity->setName($gunName);

            $manager->persist($gunEntity);
            $this->addReference($gunName, $gunEntity);
        }

        $manager->flush();
    }
}
