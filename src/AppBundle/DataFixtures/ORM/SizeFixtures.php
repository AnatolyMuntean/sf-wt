<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Size;
use AppBundle\Entity\Tank;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SizeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $sizes = [
            'Panzer II' => [
                'height' => 1990,
                'width' => 2223,
                'length' => 4810,
                'length_w_gun' => 0,
                'clearance' => 345,
            ],
            'Tiger I' => [
                'height' => 2930,
                'width' => 3705,
                'length' => 6316,
                'length_w_gun' => 8450,
                'clearance' => 470,
            ],
            'Tiger II' => [
                'height' => 3090,
                'width' => 3755,
                'length' => 7380,
                'length_w_gun' => 10286,
                'clearance' => 495,
            ],
            'Maus' => [
                'height' => 3660,
                'width' => 3670,
                'length' => 9030,
                'length_w_gun' => 10200,
                'clearance' => 500,
            ],
        ];

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
