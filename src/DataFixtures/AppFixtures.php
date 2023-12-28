<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\PasswordHasher\Hasher\PlaintextPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
      
        
        $faker = Factory::create();

        for ($u=0; $u < 10; $u++) { 
            # create User
            $user = new User();
            $passHash = $this->encoder->hashPassword($user ,'password');

            $user->setPassword($passHash)
                ->setEmail($faker->email);

            $manager->persist($user);

            for ($a=0; $a < random_int(5,20) ; $a++) { 
                # code...
                $article = (new Article())->setAuthor($user)
                            ->setName($faker->text(50))
                            ->setContent($faker->text(300));
                $manager->persist($article);                     
            }    
            
        }

        $manager->flush();
    }
}
