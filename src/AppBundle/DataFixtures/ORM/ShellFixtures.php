<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Shell;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ShellFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $shells = [
            'PzGr. 39' => [
                'abbreviation' => 'APCBC',
            ],
            'PzGr. 40' => [
                'abbreviation' => 'APCR',
            ],
            'Hl.39' => [
                'abbreviation' => 'HEAT',
            ],
        ];

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