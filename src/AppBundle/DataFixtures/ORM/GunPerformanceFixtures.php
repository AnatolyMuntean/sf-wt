<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\GunPerformance;
use AppBundle\Services\FixturesLoaderService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GunPerformanceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /** @var FixturesLoaderService $fixtureLoader */
        $fixtureLoader = $this->container->get('fixture_loader');
        $performanceData = $fixtureLoader->load('gun_performance.yml');

        foreach ($performanceData as $name => $data) {
            $gunPerformanceEntity = new GunPerformance();

            $gunPerformanceEntity->setName($name);
            $gunPerformanceEntity->setGun($this->getReference($data['gun']));
            $gunPerformanceEntity->setShell($this->getReference($data['shell']));
            $gunPerformanceEntity->setAt100($data['data']['at_100']);
            $gunPerformanceEntity->setAt250($data['data']['at_250']);
            $gunPerformanceEntity->setAt500($data['data']['at_500']);
            $gunPerformanceEntity->setAt1000($data['data']['at_1000']);
            $gunPerformanceEntity->setAt2000($data['data']['at_2000']);

            $manager->persist($gunPerformanceEntity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            GunsFixtures::class,
            ShellFixtures::class,
        ];
    }
}
