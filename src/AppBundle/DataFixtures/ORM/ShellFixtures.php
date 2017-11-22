<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Shell;
use AppBundle\Services\FixturesLoaderService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ShellFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /** @var FixturesLoaderService $fixtureLoader */
        $fixtureLoader = $this->container->get('fixture_loader');
        $shells = $fixtureLoader->load('shells.yml');

        foreach ($shells as $shellName => $shellProperties) {
            $shellEntity = new Shell();
            $shellEntity->setName($shellName);

            foreach ($shellProperties as $shellPropertyName => $shellPropertyValue) {
                switch ($shellPropertyName) {
                    case 'abbreviation':
                        $shellEntity->setAbbreviation($shellPropertyValue);
                        break;
                }
            }

            $manager->persist($shellEntity);

            $this->addReference($shellName, $shellEntity);
        }

        $manager->flush();
    }
}
