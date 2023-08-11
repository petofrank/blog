<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AuthorFixtures extends Fixture
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
         for($i = 0; $i< 10; $i++) {
             $author = new Author();
             $author->setName($this->faker->name);
             $author->setPhone($this->faker->phoneNumber);
             $author->setTitle($this->faker->title);
             $author->setStreet($this->faker->streetName);
             $author->setUsername($this->faker->userName);
             $author->setEmail($this->faker->email);
             $manager->persist($author);
         }
        $manager->flush();
    }
}
