<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Roles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RolesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $roles = [
            'ROLE_ADMIN',
        ];

        foreach ($roles as $role) {
            $roleEntity = new Roles();
            $roleEntity->setRole($role);

            $manager->persist($roleEntity);
            $this->addReference($role, $roleEntity);
        }

        $manager->flush();
    }
}
