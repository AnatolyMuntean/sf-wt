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
            ],
            'Tiger I' => [
                'guns' => ['KwK 36'],
                'weight' => 57000,
                'original_name' => 'Sd.Kfz.181',
                'engine' => 'Maybach HL230',
            ],
            'Tiger II' => [
                'guns' => ['KwK 43 L71'],
                'weight' => 70000,
                'original_name' => 'Sd.Kfz. 182',
                'engine' => 'Maybach HL230 P30',
            ],
            'Maus' => [
                'guns' => [
                    '7.5 cm KwK 37',
                    '12.8 cm Pak 44',
                ],
                'weight' => 188900,
                'original_name' => 'Sd.Kfz 205',
                'engine' => 'MB 517',
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
                        $tankEntity->addEngine($engineEntity);
                        break;
                    case 'weight':
                        $tankEntity->setWeight($tankPropertyValue);
                        break;
                    case 'original_name':
                        $tankEntity->setOriginalName($tankPropertyValue);
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
            GunsFixtures::class,
            EnginesFixtures::class,
        ];
    }
}
