<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Engine;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EnginesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $engines = [
            'Maybach HL62TR' => [
                'horsepower' => '140',
                'displacement' => '6191',
                'type' => 'S6',
            ],
            'Maybach HL230' => [
                'horsepower' => '650',
                'displacement' => '23000',
                'type' => 'V12',
            ],
            'Maybach HL230 P30' => [
                'horsepower' => '700',
                'displacement' => '23095',
                'type' => 'V12',
            ],
            'MB 517' => [
                'horsepower' => '1200',
                'displacement' => '42350',
                'type' => 'V12',
            ]
        ];

        foreach ($engines as $engineName => $engineProperties) {
            $engine = new Engine();
            $engine->setName($engineName);

            foreach ($engineProperties as $enginePropertyName => $enginePropertyValue) {
                switch ($enginePropertyName) {
                    case 'horsepower':
                        $engine->setHorsepower($enginePropertyValue);
                        break;
                    case 'displacement':
                        $engine->setDisplacement($enginePropertyValue);
                        break;
                    case 'type':
                        $engine->setType($enginePropertyValue);
                        break;
                }
            }

            $manager->persist($engine);
            $this->addReference($engineName, $engine);
        }

        $manager->flush();
    }
}
