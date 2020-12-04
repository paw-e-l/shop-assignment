<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
        for ($i = 1; $i <= 44; $i++) {
            $product = new Entity\Product();
            $product->setName(trim(substr($text, mt_rand(0, strlen($text)-60), mt_rand(40, 60))))
                ->setPrice(mt_rand(5, 500))
                ->setCurrency("PLN")
                ->setDescription($text);
                
            $manager->persist($product);
        }

        $user = new Entity\User();
        $user->setEmail('john@doe.com')
            ->setRoles([ 'ROLE_ADMIN' ])
            ->setPassword($this->passwordEncoder->encodePassword($user, 'zaqwsx'));
            
        $manager->persist($user);

        $manager->flush();
    }
}
