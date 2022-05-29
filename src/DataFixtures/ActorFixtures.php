<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $actorNumber = 1;
        $faker = Factory::create();
        for ($i = 1; $i <= 10; $i++) {
            for ($j = 1; $j <= 3; $j++) {
                $actor = new Actor();
                $actor->setFirstname($faker->firstName());
                $actor->setLastname($faker->lastName());
                $actor->setBirthDate($faker->date());
                $actor->addProgram($this->getReference('program_' . $i));
                $this->addReference('actor_' . $actorNumber, $actor);
                $actorNumber++;
                $manager->persist($actor);   
            }
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            ProgramFixtures::class,
          ];
    }
}

