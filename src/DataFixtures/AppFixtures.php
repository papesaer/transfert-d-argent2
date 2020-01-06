<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\DataFixtures\AppFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        
        $user1 = new User("supadmin");
        $user1->setPassword($this->encoder->encodePassword($user1, "supadmin1"));
        $user1->setRoles((array("ROLE_SUPADMIN")));
        $user1->setEmail("pape@gmail.com");
        $user1->setIsActif(true);
        $user1->setUsername("seck");
        $manager->persist($user1);

        $manager->flush();
    }
}
