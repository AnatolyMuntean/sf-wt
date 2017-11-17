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
            '2 cm KwK 30' => [
                'shell' => '20 × 138 mm. B',
                'caliber' => 20,
            ],
            '3.7 cm KwK 36 L/45' => [
                'shell' => '37 × 249 mm. R',
                'caliber' => 37,
            ],
            '5 cm KwK 38' => [
                'shell' => '',
                'caliber' => 50,
            ],
            '5 cm KwK 39' => [
                'shell' => '',
                'caliber' => 50,
            ],
            '7.5 cm KwK 37' => [
                'shell' => '',
                'caliber' => 75,
            ],
            '7.5 cm KwK 40' => [
                'shell' => '',
                'caliber' => 75,
            ],
            '7.5 cm KwK 42' => [
                'shell' => '75 × 640 mm. R',
                'caliber' => 75,
            ],
            'KwK 36' => [
                'shell' => '88 x 571 mm. R',
                'caliber' => 88,
            ],
            'KwK 43 L71' => [
                'shell' => '88 x 822 mm. R',
                'caliber' => 88,
            ],
            '12.8 cm Pak 44' => [
                'shell' => '128 x 869 mm. R',
                'caliber' => 128,
            ],
        ];

        foreach ($guns as $gunName => $gunProperties) {
            $gunEntity = new Gun();
            $gunEntity->setName($gunName);

            foreach ($gunProperties as $gunProperty => $gunPropertyValue) {
                switch ($gunProperty) {
                    case 'shell':
                        $gunEntity->setShell($gunPropertyValue);
                        break;
                    case 'caliber':
                        $gunEntity->setCaliber($gunPropertyValue);
                        break;
                    case 'elevation_min':
                        $gunEntity->setElevationMin($gunPropertyValue);
                        break;
                    case 'elevation_max':
                        $gunEntity->setElevationMax($gunPropertyValue);
                        break;
                    case 'traverse':
                        $gunEntity->setTraverse($gunPropertyValue);
                }
            }

            $manager->persist($gunEntity);
            $this->addReference($gunName, $gunEntity);
        }

        $manager->flush();
    }
}
