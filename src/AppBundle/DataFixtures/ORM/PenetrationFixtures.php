<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Penetration;
use AppBundle\Services\FixturesLoaderService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PenetrationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /** @var FixturesLoaderService $fixtureLoader */
        $fixtureLoader = $this->container->get('fixture_loader');
        $penetrationData = $fixtureLoader->load('penetration.yml');

        foreach ($penetrationData as $data) {
            $penetrationEntity = new Penetration();

            $penetrationEntity->setGun($this->getReference($data['gun']));
            $penetrationEntity->setShell($this->getReference($data['shell']));
            $penetrationEntity->setAt100($data['data']['at_100']);
            $penetrationEntity->setAt250($data['data']['at_250']);
            $penetrationEntity->setAt500($data['data']['at_500']);
            $penetrationEntity->setAt1000($data['data']['at_1000']);
            $penetrationEntity->setAt2000($data['data']['at_2000']);

            $manager->persist($penetrationEntity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            GunsFixtures::class,
            ShellFixtures::class,
        ];
    }
}
