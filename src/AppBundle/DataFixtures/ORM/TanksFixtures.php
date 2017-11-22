<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Engine;
use AppBundle\Entity\Gun;
use AppBundle\Entity\Tank;
use AppBundle\Services\FixturesLoaderService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TanksFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /** @var FixturesLoaderService $fixtureLoader */
        $fixtureLoader = $this->container->get('fixture_loader');
        $tanks = $fixtureLoader->load('tanks.yml');

        foreach ($tanks as $tankName => $tankProperties) {
            $tankEntity = new Tank();
            $tankEntity->setName($tankName);

            foreach ($tankProperties as $tankPropertyName => $tankPropertyValue) {
                switch ($tankPropertyName) {
                    case 'guns':
                        foreach ($tankPropertyValue as $gunName) {
                            /** @var Gun $gunEntity */
                            $gunEntity = $this->getReference($gunName);
                            $tankEntity->addGun($gunEntity);
                        }
                        break;
                    case 'engine':
                        /** @var Engine $engineEntity */
                        $engineEntity = $this->getReference($tankPropertyValue);
                        $tankEntity->setEngine($engineEntity);
                        break;
                    case 'weight':
                        $tankEntity->setWeight($tankPropertyValue);
                        break;
                    case 'catalogue_name':
                        $tankEntity->setCatalogueName($tankPropertyValue);
                        break;
                    case 'original_name':
                        $tankEntity->setOriginalName($tankPropertyValue);
                        break;
                    case 'vendor':
                        $vendorEntity = $this->getReference($tankPropertyValue);
                        $tankEntity->setVendor($vendorEntity);
                        break;
                    case 'type':
                        $vehicleTypeEntity = $this->getReference($tankPropertyValue);
                        $tankEntity->setType($vehicleTypeEntity);
                        break;
                }
            }

            $this->addReference($tankName, $tankEntity);
            $manager->persist($tankEntity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            VendorFixtures::class,
            GunsFixtures::class,
            EngineFixtures::class,
            VehicleTypeFixtures::class,
        ];
    }
}
