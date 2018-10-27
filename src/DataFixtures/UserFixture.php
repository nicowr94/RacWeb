<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder=$encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setRoles('ROLE_USER');
        $user->setSysVal(1);
        $user->setSysTime(new \DateTime());
        $user->setPassword(
            $this->encoder->encodePassword($user, 'admin')
        );

        $user->setEmail('admin@symfony.com');

        $manager->persist($user);
        $manager->flush();
    }
}

//php bin/console doctrine:fixtures:load
