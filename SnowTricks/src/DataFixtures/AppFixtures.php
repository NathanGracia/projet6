<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $userPasswordEncoder;
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder){
        $this->userPasswordEncoder = $userPasswordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $user= new User();
        $user->setEmail('nathan.gracia.863@gmail.com')
            ->setPassword($this->userPasswordEncoder->encodePassword($user,'azerty'));

        $manager->persist($user);

        $manager->flush();
    }
}
