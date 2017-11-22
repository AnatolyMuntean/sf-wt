<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Roles;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $users = [
            'admin' => [
                'password' => '1234',
                'roles' => ['ROLE_ADMIN', 'ROLE_USER'],
            ],
            'user' => [
                'password' => '1234',
                'roles' => ['ROLE_USER'],
            ],
        ];

        foreach ($users as $userName => $userProperties) {
            $userEntity = new User();
            $userEntity->setUsername($userName);

            foreach ($userProperties as $userPropertyName => $userPropertyValue) {
                switch ($userPropertyName) {
                    case 'password':
                        /** @var EncoderFactory $encoderFactory */
                        $encoderFactory = $this->container->get('security.encoder_factory');
                        $encoder = $encoderFactory->getEncoder($userEntity);
                        $encodedPassword = $encoder->encodePassword($userPropertyValue, '');
                        $userEntity->setPassword($encodedPassword);
                        break;
                    case 'roles':
                        foreach ($userPropertyValue as $roleName) {
                            /** @var Roles $roleEntity */
                            $roleEntity = $this->getReference($roleName);
                            $userEntity->addRole($roleEntity);
                        }
                        break;
                }
            }

            $manager->persist($userEntity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            RolesFixtures::class,
        ];
    }
}
