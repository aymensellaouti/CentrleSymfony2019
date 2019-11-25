<?php

namespace App\DataFixtures;

use App\Entity\Personne;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
class PersonneFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i=0 ; $i < 10 ; $i++) {
            $personne =  new Personne();
            $personne->setCin($faker->numberBetween(1000000,99999999));
            $personne->setName($faker->name);
            $personne->setAge($faker->numberBetween(0,199));
            $personne->setFirstname($faker->firstName);
            $personne->setPath($faker->imageUrl(640,480));
            $manager->persist($personne);
        }

        $manager->flush();
    }
}
