<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Roles;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserFixtures extends Fixture implements ContainerAwareInterface
{
    protected $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $users = [
            'admin' => [
                'password' => '1234',
                'roles' => ['ROLE_ADMIN'],
            ]
        ];

        foreach ($users as $userName => $userProperties) {
            $userEntity = new User();
            $userEntity->setUsername($userName);

            foreach ($userProperties as $userPropertyName => $userPropertyValue) {
                switch($userPropertyName) {
                    case 'password':
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
