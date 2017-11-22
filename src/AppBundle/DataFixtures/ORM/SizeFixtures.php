<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Size;
use AppBundle\Entity\Tank;
use AppBundle\Services\FixturesLoaderService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SizeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /** @var FixturesLoaderService $fixtureLoader */
        $fixtureLoader = $this->container->get('fixture_loader');
        $sizes = $fixtureLoader->load('sizes.yml');

        foreach ($sizes as $tankName => $size) {
            $sizeEntity = new Size();
            $sizeEntity->setHeight($size['height']);
            $sizeEntity->setWidth($size['width']);
            $sizeEntity->setLength($size['length']);
            $sizeEntity->setLengthWithGun($size['length_w_gun']);
            $sizeEntity->setClearance($size['clearance']);

            /** @var Tank $tankEntity */
            $tankEntity = $this->getReference($tankName);
            $tankEntity->setSize($sizeEntity);

            $manager->persist($sizeEntity);
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
