<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Engine;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EngineFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $engines = [
            'Maybach HL62TR' => [
                'horsepower' => '140',
                'displacement' => '6191',
                'type' => 'S6',
                'vendor' => 'Germany',
            ],
            'Maybach HL230' => [
                'horsepower' => '650',
                'displacement' => '23000',
                'type' => 'V12',
                'vendor' => 'Germany',
            ],
            'Maybach HL230 P30' => [
                'horsepower' => '700',
                'displacement' => '23095',
                'type' => 'V12',
                'vendor' => 'Germany',
            ],
            'MB 517' => [
                'horsepower' => '1200',
                'displacement' => '42350',
                'type' => 'V12',
                'vendor' => 'Germany',
            ],
        ];

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
