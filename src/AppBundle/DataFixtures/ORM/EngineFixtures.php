<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Engine;
use AppBundle\Services\FixturesLoaderService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EngineFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /** @var FixturesLoaderService $fixtureLoader */
        $fixtureLoader = $this->container->get('fixture_loader');
        $engines = $fixtureLoader->load('engines.yml');

        foreach ($engines as $engineName => $engineProperties) {
            $engineEntity = new Engine();
            $engineEntity->setName($engineName);

            foreach ($engineProperties as $enginePropertyName => $enginePropertyValue) {
                switch ($enginePropertyName) {
                    case 'horsepower':
                        $engineEntity->setHorsepower($enginePropertyValue);
                        break;
                    case 'displacement':
                        $engineEntity->setDisplacement($enginePropertyValue);
                        break;
                    case 'type':
                        $engineEntity->setType($enginePropertyValue);
                        break;
                    case 'vendor':
                        $vendorEntity = $this->getReference($enginePropertyValue);
                        $engineEntity->setVendor($vendorEntity);
                        break;
                }
            }

            $manager->persist($engineEntity);
            $this->addReference($engineName, $engineEntity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            VendorFixtures::class,
        ];
    }
}
