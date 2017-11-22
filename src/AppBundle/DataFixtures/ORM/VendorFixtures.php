<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Vendor;
use AppBundle\Services\FixturesLoaderService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class VendorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /** @var FixturesLoaderService $fixtureLoader */
        $fixtureLoader = $this->container->get('fixture_loader');
        $vendors = $fixtureLoader->load('vendors.yml');

        foreach ($vendors as $vendor) {
            $vendorEntity = new Vendor();
            $vendorEntity->setCountry($vendor);

            $this->addReference($vendor, $vendorEntity);
            $manager->persist($vendorEntity);
        }

        $manager->flush();
    }
}
