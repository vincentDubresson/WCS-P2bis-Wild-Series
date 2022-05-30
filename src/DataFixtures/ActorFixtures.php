<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager): void
    {
        $actorNumber = 1;
        $faker = Factory::create();
        for ($i = 1; $i <= 8; $i++) {
            for ($j = 1; $j <= 3; $j++) {
                $actor = new Actor();
                $actorFirstName = $faker->firstname();
                $actorLastName = $faker->lastname();
                $actorFullName = $actorFirstName . ' ' . $actorLastName;
                $actor->setFirstname($actorFirstName);
                $actor->setLastname($actorLastName);
                $actor->setSlug($this->slugify->generate($actorFullName));
                $actor->setBirthDate($faker->date());
                $actor->addProgram($this->getReference('program_' . $i));
                $secondProgram = $i + 1;
                $actor->addProgram($this->getReference('program_' . $secondProgram));
                $thirdProgram = $secondProgram + 1;
                $actor->addProgram($this->getReference('program_' . $thirdProgram));
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

