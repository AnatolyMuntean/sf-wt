<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Production;
use AppBundle\Entity\Tank;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $productions = [
            'Panzer II' => 2028,
            'Tiger I' => 1354,
            'Tiger II' => 489,
            'Maus' => 2,
        ];

        foreach ($productions as $tankName => $productionCount) {
            $productionEntity = new Production();

            $productionEntity->setCount($productionCount);

            /** @var Tank $tankEntity */
            $tankEntity = $this->getReference($tankName);
            $tankEntity->setProduction($productionEntity);

            $manager->persist($productionEntity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            TanksFixtures::class,
        ];
    }
}
