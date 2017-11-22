<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Gun;
use AppBundle\Entity\Shell;
use AppBundle\Services\FixturesLoaderService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GunsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /** @var FixturesLoaderService $fixtureLoader */
        $fixtureLoader = $this->container->get('fixture_loader');
        $guns = $fixtureLoader->load('guns.yml');

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
