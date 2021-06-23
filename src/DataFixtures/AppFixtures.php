<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{

    public $encoder;
    public $slugger;

    public function __construct(UserPasswordHasherInterface $encoder, SluggerInterface $slugger)
    {
        $this->encoder = $encoder;
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager)
    {
        
        $faker = Factory::create('fr_FR');

        for($j=0; $j<7;$j++){
            $category = new Category();
            $category->setName($faker->name())
                ->setColor($faker->hexColor)
                ->setSlug($this->slugger->slug($category->getName()));

            $manager->persist($category);

            for($k=0; $k<15; $k++){
                $product = new Product();
                $product->setCategory($category)
                    ->setName($faker->name());

                $manager->persist($product);
            }
        }

        for($i=0;$i<30;$i++){

            $user = new User();
            $user->setEmail($faker->email)
                ->setFirstName($faker->firstName)
                ->setLastName($faker->lastName)
                ->setPassword($this->encoder->hashPassword($user,'Password01'))
                ;
            $manager->persist($user);
                

        }

        $manager->flush();
    }
}
