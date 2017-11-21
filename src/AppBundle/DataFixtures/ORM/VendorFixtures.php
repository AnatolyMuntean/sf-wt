<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Vendor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class VendorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $vendors = [
            'Germany',
            'Soviet Union',
            'France',
            'USA',
            'Great Britain',
        ];

        foreach ($vendors as $vendor) {
            $vendorEntity = new Vendor();
            $vendorEntity->setCountry($vendor);

            $this->addReference($vendor, $vendorEntity);
            $manager->persist($vendorEntity);
        }

        $manager->flush();
    }
}
