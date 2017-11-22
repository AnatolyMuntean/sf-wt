<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\VehicleType;
use AppBundle\Services\FixturesLoaderService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class VehicleTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /** @var FixturesLoaderService $fixtureLoader */
        $fixtureLoader = $this->container->get('fixture_loader');
        $vehicleTypes = $fixtureLoader->load('vehicle_types.yml');

        foreach ($vehicleTypes as $vehicleType) {
            $vehicleTypeEntity = new VehicleType();
            $vehicleTypeEntity->setName($vehicleType);

            $this->addReference($vehicleType, $vehicleTypeEntity);
            $manager->persist($vehicleTypeEntity);
        }

        $manager->flush();
    }
}
