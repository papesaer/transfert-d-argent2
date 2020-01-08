<?php

namespace App\DataFixtures;

use App\Entity\User;
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
        // $product = new Product();
        // $manager->persist($product);

        $user1 = new User("supadmin");
        $user1->setPassword($this->encoder->encodePassword($user1, "admin1"));
        $user1->setRoles((array("ROLE_USER")));
        $user1->setUsername("seck");
        $user1->setIsActif(true);
        $manager->persist($user1);


        $manager->flush();
    }
}
