<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Gun;
use AppBundle\Entity\Shell;
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
                'vendor' => 'Germany',
            ],
            '3.7 cm KwK 36 L/45' => [
                'shell' => '37 × 249 mm. R',
                'caliber' => 37,
                'vendor' => 'Germany',
            ],
            '5 cm KwK 38' => [
                'shell' => '',
                'caliber' => 50,
                'vendor' => 'Germany',
            ],
            '5 cm KwK 39' => [
                'shell' => '',
                'caliber' => 50,
                'vendor' => 'Germany',
            ],
            '7.5 cm KwK 37' => [
                'shell' => '',
                'caliber' => 75,
                'vendor' => 'Germany',
            ],
            '7.5 cm KwK 40' => [
                'shell' => '',
                'caliber' => 75,
                'vendor' => 'Germany',
            ],
            '7.5 cm KwK 42' => [
                'shell' => '75 × 640 mm. R',
                'caliber' => 75,
                'vendor' => 'Germany',
            ],
            '8.8 cm KwK 36' => [
                'shell' => '88 x 571 mm. R',
                'caliber' => 88,
                'ammo' => [
                    'PzGr. 39',
                    'PzGr. 40',
                    'Hl.39',
                ],
                'vendor' => 'Germany',
            ],
            '8.8 cm KwK 43 L71' => [
                'shell' => '88 x 822 mm. R',
                'caliber' => 88,
                'ammo' => [
                    'PzGr. 39/43',
                    'PzGr. 40/43',
                    'Hl.39/3',
                ],
                'vendor' => 'Germany',
            ],
            '12.8 cm KwK 44 L55' => [
                'shell' => '128 x 869 mm. R',
                'caliber' => 128,
                'ammo' => [
                    'PzGr. 39/43',
                    'PzGr. 40/43',
                    'Hl.39/3',
                ],
                'vendor' => 'Germany',
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
                    case 'ammo':
                        foreach ($gunPropertyValue as $shellName) {
                            /** @var Shell $shellEntity */
                            $shellEntity = $this->getReference($shellName);
                            $gunEntity->addAmmo($shellEntity);
                        }
                        break;
                    case 'vendor':
                        $vendorEntity = $this->getReference($gunPropertyValue);
                        $gunEntity->setVendor($vendorEntity);
                        break;
                }
            }

            $manager->persist($gunEntity);
            $this->addReference($gunName, $gunEntity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            VendorFixtures::class,
            ShellFixtures::class,
        ];
    }
}
