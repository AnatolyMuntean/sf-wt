<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Gun;
use AppBundle\Entity\Tank;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TanksFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tanks = [
            'Panzer II' => '2 cm KwK 30',
            'Tiger I' => 'KwK 36',
            'Tiger II' => 'KwK 43 L71'
        ];

        foreach ($tanks as $tankName => $gunName) {
            $tankEntity = new Tank();
            $tankEntity->setName($tankName);

            /** @var Gun $gunEntity */
            $gunEntity = $this->getReference($gunName);
            $tankEntity->addGun($gunEntity);

            $manager->persist($tankEntity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            GunsFixtures::class,
        ];
    }
}
