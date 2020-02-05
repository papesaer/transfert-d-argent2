<?php

namespace App\DataFixtures;

use App\Entity\Role;
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
        // On configure dans quelles langues nous voulons nos données
        
        $user1 = new User("supadmin");
        $user1->setPassword($this->encoder->encodePassword($user1, "groupe1"));
        $user1->setNomComplete("pape saer seck");
        $user1->setRoles(array("ROLE_SUPADMIN"));
        $user1->setIsActif(true);
        $user1->setTelephone(778901234);
        $user1->setUsername("seck");
        $user1->setImage("https://www.google.com/url?sa=i&source=images&cd=&cad=rja&uact=8&ved=2ahUKEwiT9pOm5ZnnAhWV3oUKHf2ABloQjRx6BAgBEAQ&url
        =http%3A%2F%2Fimages.wowcorp.com%2F&psig=AOvVaw3023pTyhu2lldF0HPCMpQ6&ust=1579871245190242");
        $manager->persist($user1);

        $roles = new Role();

        $roles1 = new Role();

        $roles2 = new Role();

        $roles3 = new Role();
        
        $roles->setLibelle("ROLE_SUPADMIN");
        $roles1->setLibelle("ROLE_ADMIN");
        $roles2->setLibelle("ROLE_CAISSIER");
        $roles3->setLibelle("ROLE_PARTENAIRE");
        $manager->persist($roles);
        $manager->persist($roles1);
        $manager->persist($roles2);
        $manager->persist($roles3);

        $manager->flush();

    

    }    
}
