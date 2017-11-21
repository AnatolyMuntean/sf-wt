<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Engine;
use AppBundle\Entity\Gun;
use AppBundle\Entity\Tank;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TanksFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tanks = [
            'Panzer II' => [
                'guns' => ['2 cm KwK 30'],
                'weight' => 9400,
                'original_name' => 'Sd.Kfz. 121',
                'engine' => 'Maybach HL62TR',
                'vendor' => 'Germany',
            ],
            'Tiger I' => [
                'guns' => ['8.8 cm KwK 36'],
                'weight' => 57000,
                'original_name' => 'Sd.Kfz.181',
                'engine' => 'Maybach HL230',
                'vendor' => 'Germany',
            ],
            'Tiger II' => [
                'guns' => ['8.8 cm KwK 43 L71'],
                'weight' => 70000,
                'original_name' => 'Sd.Kfz. 182',
                'engine' => 'Maybach HL230 P30',
                'vendor' => 'Germany',
            ],
            'Maus' => [
                'guns' => [
                    '7.5 cm KwK 37',
                    '12.8 cm KwK 44 L55',
                ],
                'weight' => 188900,
                'original_name' => 'Sd.Kfz 205',
                'engine' => 'MB 517',
                'vendor' => 'Germany',
            ],
        ];

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
                    case 'original_name':
                        $tankEntity->setOriginalName($tankPropertyValue);
                        break;
                    case 'vendor':
                        $vendorEntity = $this->getReference($tankPropertyValue);
                        $tankEntity->setVendor($vendorEntity);
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
        ];
    }
}
