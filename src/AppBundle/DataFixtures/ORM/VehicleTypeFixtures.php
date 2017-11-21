<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\VehicleType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class VehicleTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $vehicleTypes = [
            'Light tank',
            'Medium tank',
            'Heavy tank',
            'Tank destroyer',
            'Self-propelled gun',
        ];

        foreach ($vehicleTypes as $vehicleType) {
            $vehicleTypeEntity = new VehicleType();
            $vehicleTypeEntity->setName($vehicleType);

            $this->addReference($vehicleType, $vehicleTypeEntity);
            $manager->persist($vehicleTypeEntity);
        }

        $manager->flush();
    }
}
